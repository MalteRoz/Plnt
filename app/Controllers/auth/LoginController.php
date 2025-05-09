<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/LoginModel.php';


class LoginController extends LoginModel
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser()
    {
        if (!$this->isInputValid()) {
            throw new Exception("Empty fields");
        }

        $user = $this->getUser($this->email, $this->password);

        if ($user) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION["userid"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["created_at"] = $user["created_at"];
        } else {
            throw new Exception("Login failed");
        }
    }

    private function isInputValid()
    {
        return !empty($this->email) && !empty($this->password);
    }
}
