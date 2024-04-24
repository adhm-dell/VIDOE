<?php
require_once '../Models/User.php';
require_once '../Controllers/DBController.php';
class Auth
{
    private DBController $db;

    public function __construct()
    {
        $this->db = new DBController();
    }
    public function login(User $user)
    {
        // implement this function
    }
    public function register(User $user)
    {
        // implement this function
    }
    public function logout(User $user)
    {
        // implement this function
    }
}
