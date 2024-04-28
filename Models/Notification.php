<?php

class Notification
{
    private int $notify_id;
    private int $user_id;
    private string $content;

    public function setNotify_id(int $id): void
    {
        $this->notify_id = $id;
    }
    public function setNotifyContent(string $content): void
    {
        $this->notify_id = $content;
    }
    public function setNotifyUser_id(int $userId): void
    {
        $this->user_id = $userId;
    }
    public function getNotify_id(): int
    {
        return $this->notify_id;
    }
    public function getNotifyContent(): string
    {
        return $this->content;
    }
    public function getNotifyUser_id(): int
    {
        return $this->user_id;
    }
}
