<?php

class Comments
{
    private int $comment_id;
    private int $user_id;
    private string $content;
    private DateTime $date;
    private int $video_id;


    // setters
    public function setCommentId(int $comment_id): void
    {
        $this->comment_id = $comment_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    public function setVideoId(int $video_id): void
    {
        $this->video_id = $video_id;
    }

    // getters
    public function getCommentId(): int
    {
        return $this->comment_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getVideoId(): int
    {
        return $this->video_id;
    }
}
