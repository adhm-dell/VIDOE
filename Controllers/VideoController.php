<?php
require_once '../Controllers/DBController.php';
require_once '../Models/Video.php';

class VideoController
{
    private DBController $db;

    public function getAllVideos(): array
    {
        //implement this 
        return [];
    }
    public function getVideoById(int $id): Video
    {
        //implement this 
        return new Video();
    }
    public function createVideo(Video $video): bool
    {
        //implement this 
        return false;
    }
    public function deleteVideo(int $video_id): bool
    {
        //implement this 
        return false;
    }
    public function searchVideo(string $video_name): Video
    {
        //implement this 
        return new Video();
    }
    public function getChannelVidoes(int $channel_id): array
    {
        //implement this 
        return [];
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
    public function getRelatedVideos(int $cat_id): array
    {
        //implement this 
        return [];
    }
}
