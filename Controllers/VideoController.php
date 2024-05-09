<?php
require_once '../Controllers/DBController.php';
require_once '../Models/Video.php';

class VideoController
{
    private DBController $db;
    private $errors = [];

    public function __construct()
    {
        $this->db = new DBController();
    }

    public function getAllVideos(): array | bool
    {
        if ($this->db->openConnection()) {
            $videos = $this->db->selectWithInnerJoinThreeTables('', '', '', 'video_category', 'video', 'video_category.video_id=video.id', 'category', 'video_category.category_id = category.id');
            return $videos;
        } else {
            return false;
        }
    }
    public function getAllVideoByCategory(int $cat_id): array
    {
        if ($this->db->openConnection()) {
            $whereClause = '(category_id = ' . "'" . $cat_id . "'" . ')';
            $videos = $this->db->select($whereClause, '', '', 'video');
            return $videos;
        } else {
            $errors['invalid_cat_id'] = 'invalid category';
            return false;
        }
    }
    public function getVideoById(int $id): Video
    {
        if ($this->db->openConnection()) {
            $whereClause = '(id = ' . "'" . $id . "'" . ')';
            $data = $this->db->select($whereClause, '', 1, 'video');
            $video = new Video();
            $video->setVideoId($data[0]['id']);
            $video->setVideoTitle($data[0]['title']);
            $video->setVideoDescription($data[0]['descreption']);
            $video->setUploadDate($data[0]['upload_date']);
            $video->setVideoThumbnail($data[0]['thumbnail']);
            $video->setVideoUrl($data[0]['file_path']);
            $video->setChannelId($data[0]['channel_id']);
            $video->setViews($data[0]['watches']);
            // $video->setLikes($data[0]['likes']);
            // $video->setComments($data[0]['comments']);
            $video->setCategoryId($data[0]['category_id']);
            $video->setNumOfReports($data[0]['num_of_reports']);
            return $video;
        } else {
            return false;
        }
    }
    public function getVideoCategory(int $cat_id): array
    {
        if ($this->db->openConnection()) {
            $category = $this->db->select('(id = ' . "'" . $cat_id . "'" . ')', '', '', 'category');
            return $category;
        } else {
            return false;
        }
    }
    public function setVideoData(array $data): Video
    {
        session_start();
        $video = new Video();
        $video->setVideoTitle($_POST['title']);
        $video->setVideoDescription($_POST['description']);
        $video->setViews(0);
        $video->setLikes(0);
        $video->setComments(0);
        $video->setCategoryId((int) $_POST['category']);
        $video->setChannelId($_SESSION['channel_id']);
        return $video;
    }
    public function createVideo(Video $video): bool
    {
        if ($this->db->openConnection()) {
            $video_data = [
                "title" => $video->getVideoTitle(),
                "descreption" => $video->getVideoDescription(),
                "upload_date" => date('Y-m-d'),
                "thumbnail" => $video->getVideoThumbnail(),
                "file_path" => $video->getVideoUrl(),
                "channel_id" => $video->getChannelId(),
                "category_id" => $video->getCategoryId(),
                "watches" => 0,
                "num_of_reports" => 0
            ];
            $insertion_id = $this->db->insert($video_data, "video");
            if ($insertion_id > 0) {
                $video->setVideoId($insertion_id);
                $video_categoryData = [
                    "video_id" => $video->getVideoId(),
                    "category_id" => $video->getCategoryId()
                ];
                $res = $this->db->insert($video_categoryData, "video_category");
                if ($res > 0) {
                    return true;
                }
            } else {
                if ($video->getVideoTitle() == '') {
                    $this->errors['title'] = "Please enter a title for the video";
                }
                if ($video->getVideoDescription() == '') {
                    $this->errors['description'] = "Please enter a description for the video";
                }
                if ($video->getVideoUrl() == '') {
                    $this->errors['video'] = "Please upload a video";
                }
                if ($video->getVideoThumbnail() == '') {
                    $this->errors['thumbnail'] = "Please upload a photo for the video";
                }
                if ($video->getCategoryId() === 0) {
                    $this->errors['category'] = "Please enter a category for the video";
                }
                return false;
            }
        }
        $this->db->closeConnection();
        return true;
    }
    public function deleteVideo(int $video_id): bool
    {
        if ($this->db->openConnection()) {
            $whereClause = '(id = ' . "'" . $video_id . "'" . ')';
            $videoData = $this->db->select($whereClause, '', 1, 'video');
            $thumbnail = $videoData[0]['thumbnail'];
            $filePath = $videoData[0]['file_path'];
            unlink($thumbnail);
            unlink($filePath);
            $this->db->delete($video_id, 'video');
            $this->db->delete($video_id, 'video_playlist');
            $this->db->delete($video_id, 'video_category');
            return true;
        } else {
            return false;
        }
    }
    public function searchVideo(string $video_name): array
    {
        $data = self::getAllVideos();
        $minDistance = PHP_INT_MAX; // Initialize with maximum integer value
        $closestName = null;

        foreach ($data as $name) {
            $distance = levenshtein(strtolower($video_name), strtolower($name['title']));
            $distances[$name['id']] = $distance;
        }
        asort($distances, SORT_NUMERIC);
        foreach (array_keys($distances) as $id) {
            if ($this->db->openConnection()) {
                $whereClause = '(id = ' . "'" . $id . "'" . ')';
                $videos[] = $this->db->select($whereClause, '', '1', 'video');
            }
        }
        return $videos;
    }


    public function getRelatedVideos(int $cat_id, $vid_id): array
    {
        if ($this->db->openConnection()) {
            $whereClause = '(category_id = ' . "'" . $cat_id . "'" . 'and id !=' . "'" . $vid_id . "'" . ')';
            $videos = $this->db->select($whereClause, '', '', 'video');
            return $videos;
        } else {
            return false;
        }
    }

    public function getVideoErrors(): array
    {
        return $this->errors;
    }

    public function setView(int $video_id, $user_id): bool
    {
        if ($this->db->openConnection()) {
            $data = [
                "video_id" => $video_id,
                "user_id" => $user_id
            ];
            $insertion_id = $this->db->insert($data, 'views');
            $video = $this->getVideoById($video_id);
            $watches = $video->getViews() + 1;
            $this->db->update($video_id, ['watches' => $watches], 'video');
            return true;
            $this->db->closeConnection();
        } else {
            return false;
        }
    }
    public function getHistory(int $user_id): array
    {
        if ($this->db->openConnection()) {
            $data = $this->db->selectWithInnerJoin('(user_id =' . "'" . $user_id . "'" . ')', 'views.id DESC', '', 'views', 'video', 'views.video_id = video.id');
            return $data;
            $this->db->closeConnection();
        } else {
            return false;
        }
    }
    public function getAllCategories(): array
    {
        if ($this->db->openConnection()) {
            $categories = $this->db->select('', '', '', 'category');
            return $categories;
            $this->db->closeConnection();
        } else {
            return false;
        }
    }
}
