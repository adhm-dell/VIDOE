<?php
require_once '../Controllers/DBController.php';
require_once '../Models/Video.php';

class VideoController
{
    private DBController $db;
    private $errors = [];

    public function __construct(){
        $this->db = new DBController();
    }

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
        if($this->db->openConnection()){
            $video_data = [
                "title" => $video->getVideoTitle(),
                "descreption" => $video->getVideoDescription(),
                "file_path" => $video->getVideoUrl(),
                "thumbnail" => $video->getVideoThumbnail(),
                "category_id" => $video->getCategoryId(),
                "watches" => 0,
                "num_of_reports" => 0
            ];
            $insertion_id = $this->db->insert($video_data, "video");
            if($insertion_id > 0){
                $video->setVideoId($insertion_id);
                $_SESSION['videoid'] = $video->getVideoId();
                $_SESSION['videoTitle'] = $video->getVideoTitle();
                $_SESSION['videoDescription'] = $video->getVideoDescription();
                $_SESSION['videoPath'] = $video->getVideoUrl();
                $_SESSION['videoThumbnail'] = $video->getVideoThumbnail();
                $_SESSION['videoCategory'] = $video->getCategoryId();
                return true;
            }else{
                if($video->getVideoTitle() == ''){
                    $this->errors['title'] = "Please enter a title for the video";
                }
                if($video->getVideoDescription() == ''){
                    $this->errors['description'] = "Please enter a description for the video";
                }
                if($video->getVideoUrl() == ''){
                    $this->errors['video'] = "Please upload a video";
                }
                if($video->getVideoThumbnail() == ''){
                    $this->errors['thumbnail'] = "Please upload a photo for the video";
                }
                if($video->getCategoryId() === 0){
                    $this->errors['category'] = "Please enter a category for the video";
                }
                return false;
            }
        }
        $this->db->closeConnection();
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

    public function getVideoErrors() : array{
        return $this->errors;
    }
}
