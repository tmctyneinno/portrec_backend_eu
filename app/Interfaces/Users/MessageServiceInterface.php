<?php

namespace App\Interfaces\Users;

use App\Dtos\MessageCreationDto;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Pagination\LengthAwarePaginator;

interface MessageServiceInterface
{
    public function saveMessage(MessageCreationDto $messageData): ?Conversation;

    public function findConversation(string $conversationId): ?Conversation;

    public function fetchConversations(string $perPage): LengthAwarePaginator;

    public function fetchMessages(string $conversationId, string $perPage): LengthAwarePaginator;

    public function markAsRead(string $id): null|bool;

    public function getMessagesCount();

    public function deleteMessage(string $messageId, string $type);
}
