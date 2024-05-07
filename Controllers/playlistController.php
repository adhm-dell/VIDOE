<?php
require_once "../Controllers/DBController.php";
require_once "../Models/PlayLists.php";

class playlistController
{
    private DBController $db;
    private $errors = [];

    public function __construct(){
        $this->db = new DBController();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function createPlaylist(PlayLists $playlist): bool
    {
        if ($this->db->openConnection()) {
            $data = [
                "name" => $playlist->getPlaylist_name(),
                "description" => $playlist->getDescription(),
                "user_id" => $playlist->getUser_id(),
            ];
            $insertionRes = $this->db->insert($data, "playlist");
            if ($insertionRes > 0) {
                $playlist->setPlaylist_id($insertionRes);
                $this->db->closeConnection();
                return true;
            } else {
                if($playlist->getPlaylist_name() == ''){
                    $this->errors['name'] = "please Enter playlist's name";
                }
                if($playlist->getDescription() == ''){
                    $this->errors['about'] = "please Enter playlist's description";
                }
                $this->db->closeConnection();
                return false;
            }
        } else {
            $this->db->closeConnection();
            return false;
        }
    }

    public function addVideosToPlaylist($playlist_id, $video_id): bool
    {
        if($this->db->openConnection()){
            $data = [
                "video_id" => $video_id,
                "playlist_id" => $playlist_id
            ];
            $this->db->insert($data, "video_playlist");
            $this->db->closeConnection();
            return true;
        }else{
            return false;
        }
    }

    public function deleteVideosFromPlaylist($video_id): bool
    {
        if($this->db->openConnection()){
            $res = $this->db->delete($video_id, "video_playlist");
            if($res === 0){
                return false;
            }else{
                return true;
            }
            $this->db->closeConnection();
        }
    }

}
