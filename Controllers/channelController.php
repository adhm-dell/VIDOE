<?php

class channelController
{
    private DBController $db;
    private $errors = [];

    public function __construct()
    {
        $this->db = new DBController();
    }

    public function getChannelData(int $channel_id): array
    {
        if ($this->db->openConnection()) {
            $whereClause = '(id = ' . "'" . $channel_id . "'" . ')';
            $channel = $this->db->select($whereClause, '', '', 'channel');
            return $channel;
        } else {
            return false;
        }
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
        if ($this->db->openConnection()) {
            $data = [
                "channel_id" => $channel_id,
                "user_id" => $user_id
            ];
            $res = $this->db->insert($data, 'subscriptions');
            if ($res > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function handleChannelUnSubscribtions(int $channel_id, int $user_id): bool
    {
        if ($this->db->openConnection()) {
            $qry = "DELETE FROM `subscriptions` WHERE `channel_id`" . $channel_id . "=  AND `user_id` = " . $user_id;
            return $this->db->Query($qry);
        } else {
            return false;
        }
    }

    public function createChannel(Channel $channel): bool
    {
        if ($this->db->openConnection()) {
            $data = [
                "name" => $channel->getName(),
                "creation_date" => date('Y-m-d'),
                "logo" => $channel->getLogo(),
                "user_id" => $channel->getUserId(),
                "subscribers" => $channel->getSubscriptions(),
                "cover_photo" => $channel->getCoverPhoto()
            ];
            $insertionRes = $this->db->insert($data, "channel");
            $_SESSION['channel_id'] = $insertionRes;
            if ($insertionRes > 0) {
                $channel->setChannelId($insertionRes);
                session_start();
                $this->db->update($_SESSION['userid'], ['channel_id' => $channel->getChannelId()], 'users');
                $this->db->closeConnection();
                return true;
            } else {
                if ($channel->getName() === '') {
                    $this->errors['name'] = "Please enter a name for channel";
                }
                if ($channel->getLogo() === '') {
                    $this->errors['Logo'] = "Please enter a Logo for channel";
                }
                if ($channel->getCoverPhoto() === '') {
                    $this->errors['cover'] = "Please enter a cover photo for channel";
                }
                $this->db->closeConnection();
                return false;
            }
        } else {
            return false;
        }
    }

    public function getAllChannels(): array|bool
    {
        if ($this->db->openConnection()) {
            $channels = $this->db->select('', '', '', 'channel');
            return $channels;
        } else {
            return false;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
