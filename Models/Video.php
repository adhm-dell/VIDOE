<?php

class Video
{
    private int $video_id;
    private string $video_title = '';
    private string $video_description = '';
    private string $video_url = '';
    private string $video_thumbnail = '';
    private int $category_id = 0;
    private int $channel_id;
    private int $views;
    private int $likes; //need to be added in class diagram
    private int $comments; //need to be added in class diagram
    // private int $duration; //need to be added in class diagram //! ???
    private string $created_at; //need to be added in class diagram

    public function setVideoId(int $video_id): void
    {
        $this->video_id = $video_id;
    }

    public function setVideoTitle(string $video_title): void
    {
        $this->video_title = $video_title;
    }

    public function setVideoDescription(string $video_description): void
    {
        $this->video_description = $video_description;
    }

    public function setVideoUrl(string $video_url): void
    {
        $this->video_url = $video_url;
    }

    public function setVideoThumbnail(string $video_thumbnail): void
    {
        $this->video_thumbnail = $video_thumbnail;
    }

    public function setChannelId(int $channel_id): void
    {
        $this->channel_id = $channel_id;
    }

    public function setViews(int $views): void
    {
        $this->views = $views;
    }

    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    public function setComments(int $comments): void
    {
        $this->comments = $comments;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->category_id = $categoryId;
    }

    // public function setDuration(int $duration): void
    // {
    //     $this->duration = $duration;
    // }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    // getters
    public function getVideoId(): int
    {
        return $this->video_id;
    }

    public function getVideoTitle(): string
    {
        return $this->video_title;
    }

    public function getVideoDescription(): string
    {
        return $this->video_description;
    }

    public function getVideoUrl(): string
    {
        return $this->video_url;
    }

    public function getVideoThumbnail(): string
    {
        return $this->video_thumbnail;
    }

    public function getChannelId(): int
    {
        return $this->channel_id;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function getComments(): int
    {
        return $this->comments;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    // public function getDuration(): int
    // {
    //     return $this->duration;
    // }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}
