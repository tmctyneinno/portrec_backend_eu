<?php

namespace App\Http\Controllers;

use App\Dtos\MessageCreationDto;
use App\Http\Controllers\Base\BaseController;
use App\Http\Requests\MessageCreationRequest;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use App\Interfaces\MessageServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends BaseController
{
    public function __construct(
        public readonly MessageServiceInterface $messageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:conversations,messages',
            'conversation_id' => 'nullable|required_if:type,messages',
        ]);

        $perPage = $request->input('per_page') ?? 10;
        $type = $request->input('type') ?? 'conversations';
        $collection = match ($validatedData['type']) {
            'conversations' => ConversationResource::collection($this->messageService->fetchConversations($perPage))->response()->getData(true),

            'messages' => MessageResource::collection($this->messageService->fetchMessages($validatedData['conversation_id'], $perPage))->response()->getData(true),
        };

        return $this->successMessage([$type => $collection]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function markAsRead(string $id)
    {
        $isMarked = $this->messageService->markAsRead($id);

        return match ($isMarked) {
            null => $this->errorMessage('Conversation not found', Response::HTTP_NOT_FOUND),
            false => $this->errorMessage('We ran into an error while trying to handle your request, please try again', Response::HTTP_SERVICE_UNAVAILABLE),
            true => $this->successMessage(['marked' => true], Response::HTTP_OK),
            default => $this->errorMessage('An unknown error occured, please try again later'),
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageCreationRequest $request)
    {
        $validatedData = MessageCreationDto::fromRequest($request->validated());

        $conversation = $this->messageService->saveMessage($validatedData);

        if (!$conversation) {
            return $this->errorMessage('We ran into an error while trying to handle your request, please try again');
        }
  
        return $this->successMessage(
            [
                'conversation' => new ConversationResource($conversation->load(['user' => function ($query) {
                        return $query->select(['id', 'name'])->with('profile:user_id,image_path,phone,avatar,location');
                    },
                    'recruiter:id,name,location,recruiter_level',
                    'messages'
                ]))
            ],
            'Message sent successfully',
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $conversationId)
    {
        $conversation = $this->messageService->findConversation($conversationId);

        if (!$conversation) {
            return $this->errorMessage('Conversation not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successMessage(['conversation' => new ConversationResource($conversation)]);
    }

    public function messagesCount()
    {
        $counts = $this->messageService->getMessagesCount();

        return $this->successMessage(['messages_count' => $counts]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:conversation,message',
        ]);

        $deleted = $this->messageService->deleteMessage($id, $validatedData['type']);
        if ($deleted) {
            return $this->successMessage($deleted, $validatedData['type'] . ' deleted successfully');
        }

        return $this->errorMessage($validatedData['type'] . ' not found', Response::HTTP_NOT_FOUND);
    }
}
