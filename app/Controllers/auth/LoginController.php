<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/LoginModel.php';


class LoginController
{
    private $email;
    private $password;
    private $loginModel;


    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->loginModel = new LoginModel();
    }

    public function loginUser()
    {
        if (!$this->isInputValid()) {
            throw new Exception("Empty fields");
        }

        $user = $this->loginModel->getUser($this->email, $this->password);

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
