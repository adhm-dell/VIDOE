<?php
require_once '../Models/User.php';
require_once '../Controllers/DBController.php';
require_once '../Controllers/Validator.php';
class Auth
{
    private DBController $db;
    private $errors = [];

    public function __construct()
    {
        $this->db = new DBController();
    }
    public function login(User $user): bool
    {
        if ($this->db->openConnection()) {
            $whereClause = '';
            if ($user->getUsername()) {
                $whereClause = '(username = ' . "'" . $user->getUsername() . "'" . ')';
            } else {
                $whereClause = '(email = ' . "'" . $user->getEmail() . "'" . ')';
            }
            $results = $this->db->select($whereClause, null, 1, 'users');
            if (count($results) != 0) {
                if ($results[0]['password'] == $user->getPassword()) {
                    session_start();
                    $_SESSION['userid'] = $results[0]['id'];
                    $_SESSION['username'] = $results[0]['username'];
                    $_SESSION['email'] = $results[0]['email'];
                    $_SESSION['country'] = $results[0]['country'];
                    $_SESSION['profile_pic'] = $results[0]['profile_pic'];
                    $_SESSION['channel_id'] = $results[0]['channel_id'];
                    return true;
                } else {
                    $this->errors['password'] = 'Invalid password';
                    return false;
                }
            } else {
                $this->errors['username_or_email'] = 'Invalid username or email';
                return false;
            }
            $this->db->closeConnection();
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }


    public function register(User $user): bool
    {
        if ($this->db->openConnection()) {
            $userData = [
                "username" => $user->getUsername(),
                "password" =>  $user->getPassword(),
                "email" =>  $user->getEmail(),
                "country" =>  $user->getCountry(),
                "profile_pic" =>  $user->getPic()
            ];
            $insertionResult = $this->db->insert($userData, "users");
            if ($insertionResult > 0) {
                $user->setId($insertionResult);
                $_SESSION['userid'] = $user->getId();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['password'] = $user->getPassword();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['country'] = $user->getCountry();
                $_SESSION['profile_pic'] = $user->getPic();
                return true;
            } else {
                if ($user->getUsername() == "") {
                    $this->errors['username'] = "Please enter a username";
                }
                if ($user->getPassword() == "") {
                    $this->errors['password'] = "Please enter a password";
                }
                if ($user->getEmail() == "") {
                    $this->errors['email'] = "Please enter an Email";
                }
                if ($user->getCountry() == "") {
                    $this->errors['country'] = "Please enter your country";
                }
                return false;
            }
            $this->db->closeConnection();
        }
    }
    public function logout()
    {
        session_destroy();
        header("Location: ../View/login.php");
    }
}
