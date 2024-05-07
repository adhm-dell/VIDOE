<?php

class channelController
{
    private DBController $db;
    private $errors = [];

    public function __construct(){
        $this->db = new DBController();
    }

    public function getChannelVidoes(int $channel_id): array
    {
        if ($this->db->openConnection()) {
            $whereClause = '(channel_id = ' . "'" . $channel_id . "'" . ')';
            $videos = $this->db->select($whereClause, '', '', 'video');
            return $videos;
        } else {
            return false;
        }
    }

    public function handleChannelSubscribtions(int $channel_id, int $user_id): bool
    {
        //implement this
        return false;
    }

    public function handleChannelUnSubscribtions(int $channel_id, int $user_id): bool
    {
        //implement this
        return false;
    }

    public function createChannel(): bool
    {
        //implement this
        return false;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
