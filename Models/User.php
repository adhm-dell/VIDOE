<?php

class User
{
    private string $username = '';
    private string $password = '';
    private string $email = '';
    private string $profilePic = '';
    private string $country = '';
    private int $id;
    private int $channel_id;

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPic(string $profilePic): void
    {
        $this->profilePic = $profilePic;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setChannel_Id(int $channel_id): void
    {
        $this->$channel_id = $channel_id;
    }
    public function setCountry(string $coun): void
    {
        $this->country = $coun;
    }
    public function getUsername(): string | bool
    {
        if ($this->username) {
            return $this->username;
        } else {
            return false;
        }
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getEmail(): string | bool
    {
        if ($this->email) {
            return $this->email;
        }
        return false;
    }
    public function getPic(): string
    {
        return $this->profilePic;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getChannel_Id(): int
    {
        return $this->channel_id;
    }
    public function getCountry(): string
    {
        return $this->country;
    }
}
