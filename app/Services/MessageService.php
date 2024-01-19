<?php

namespace App\Services;

use App\Dtos\MessageCreationDto;
use App\Interfaces\FileUploadServiceInterface;
use App\Interfaces\MessageServiceInterface;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Throwable;

class MessageService implements MessageServiceInterface
{
    public function __construct(
        public readonly FileUploadServiceInterface $fileUploadService
    ) {
    }

    public function saveMessage(MessageCreationDto $messageData): ?Conversation
    {
        $user = auth()->user();
        $recruiter = auth('recruiter')->user();

        try {
            DB::beginTransaction();

            [$fileName, $filePath, $publicId] = $this->getAttachment($messageData->attachment);

            $conversation = Conversation::query()
                ->where('id', $messageData->conversation_id)
                ->first();

            if (!$conversation) {
                $conversation = Conversation::query()
                    ->create([
                        'user_id' => $user?->id ?? $messageData->recipient_id,
                        'recruiter_id' => $recruiter?->id ?? $messageData->recipient_id,
                        'is_user_read' => $user?->id ? 1 : 0,
                        'is_recruiter_read' => $recruiter?->id ? 1 : 0,
                    ]);
            }

            Message::query()
                ->where('conversation_id', $conversation->id)
                ->where('recipient_id', $user?->id ?? $recruiter?->id)
                ->update(['is_read' => 1]);

            Message::query()
                ->create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $user?->id ?? $recruiter?->id,
                    'recipient_id' => $messageData->recipient_id,
                    'message' => $messageData->message,
                    'attachment' => $filePath ?? null,
                    'attachment_public_id' => $publicId ?? null,
                ]);

            DB::commit();

            return $conversation;
        } catch (Throwable $e) {
            logger($e);
            DB::rollBack();
            return null;
        }
    }

    private function getAttachment(?UploadedFile $attachment): ?array
    {
        if ($attachment instanceof UploadedFile) {
            return $this->fileUploadService->upload($attachment, 'messages');
        }

        return null;
    }

    public function getMessagesCount()
    {
        $user = auth()->user();
        $recruiter = auth('recruiter')->user();

        $conversations = Conversation::query()
            ->when($user, function (Builder $query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($recruiter, function (Builder $query) use ($recruiter) {
                $query->where('recruiter_id', $recruiter->id);
            })
            ->withCount(['messages' => function ($query) use ($user, $recruiter) {
                return $query->where('recipient_id', $user?->id ?? $recruiter?->id)
                    ->where('is_read', 0);
            }])
            ->when($user, function (Builder $query) {
                $query->where('is_user_read', 0);
            })
            ->when($recruiter, function (Builder $query) {
                $query->orWhere('is_recruiter_read', 0);
            });

        if ($conversations->count() < 2) {
            return $conversations->count();
        }

        return $conversations->first()->messages_count;
    }

    public function findConversation(string $conversationId): ?Conversation
    {
        try {
            $message = Conversation::query()
                ->where('id', $conversationId)
                ->with(['user:id,name,phone,role,gender', 'recruiter:id,name,recruiter_level,location', 'messages' => function ($query) {
                    return $query->latest();
                }])
                ->withCount('messages')
                ->firstOrFail();

            return $message;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function markAsRead(string $id): null|bool
    {
        $user = auth()->user();
        $recruiter = auth('recruiter')->user();

        try {
            $conversation = Conversation::query()
                ->where('id', $id)
                ->firstOrFail();

            try {
                DB::beginTransaction();

                if ($conversation && $conversation->update([
                    'is_user_read' => $user ? 1 : $conversation->is_user_read,
                    'is_recruiter_read' => $recruiter ? 1 : $conversation->is_recruiter_read,
                ])) {
                    Message::query()
                        ->where('conversation_id', $conversation->id)
                        ->where('recipient_id', $user?->id ?? $recruiter?->id)
                        ->update(['is_read' => 1]);

                    DB::commit();
                    return true;
                }
            } catch (Throwable $e) {
                logger($e);
                DB::rollBack();
                return false;
            }
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function fetchConversations(string $perPage): LengthAwarePaginator
    {
        $user = auth()->user();
        $recruiter = auth('recruiter')->user();

        $conversations = Conversation::query()
            ->where('recruiter_id', $recruiter?->id)
            ->orWhere('user_id', $user?->id)
            ->with(['user:id,name,phone,role,gender', 'recruiter:id,name,location,recruiter_level', 'messages'])
            ->withCount('messages')
            ->paginate($perPage)
            ->appends(request()->query());
        return $conversations;
    }

    public function fetchMessages(string $conversationId, string $perPage): LengthAwarePaginator
    {
        $messages = Message::query()
            ->where('conversation_id', $conversationId)
            ->latest()
            ->paginate($perPage)
            ->appends(request()->query());

        return $messages;
    }

    public function deleteMessage(string $messageId, string $type)
    {
        $user = auth()->user();
        $recruiter = auth('recruiter')->user();

        try {
            if ($type === 'conversation') {
                $deleted = Conversation::query()
                    ->where('id', $messageId)
                    ->where('user_id', $user?->id)
                    ->orWhere('recruiter_id', $recruiter?->id)
                    ->delete();

                return $deleted;
            }

            $message = Message::query()
                ->where('id', $messageId)
                ->where('sender_id', $user?->id ?? $recruiter?->id)
                ->orWhere('recipient_id', $recruiter?->id ?? $user?->id)
                ->with(['conversation' => function (Builder $query) {
                    return $query->withCount('messages');
                }])
                ->get();

            if ($message->conversation->messages_count < 2) {
                $message->conversation->delete();
            }

            $message->delete();

            return $message;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}
