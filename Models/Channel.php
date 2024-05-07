<?php

class Channel
{
    private int $channel_id;
    private int $user_id;
    private string $name;
    private string $logo;
    private string $coverPhoto;
    private int $subscriptions;

    public function setChannelId(int $id): void
    {
        $this->channel_id = $id;
    }
    public function setUserId(int $id): void
    {
        $this->user_id = $id;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }
    public function setSubscriptions(int $subscriptions): void
    {
        $this->subscriptions = $subscriptions;
    }
    public function setCoverPhoto(int $coverPhoto): void
    {
        $this->coverPhoto = $coverPhoto;
    }
    public function getChannelId(): int
    {
        return $this->channel_id;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getLogo(): string
    {
        return $this->logo;
    }
    public function getSubscriptions(): int
    {
        return $this->subscriptions;
    }
    public function getCoverPhoto(): int
    {
        return $this->coverPhoto;
    }
}
