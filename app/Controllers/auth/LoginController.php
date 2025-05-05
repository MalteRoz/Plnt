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
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        $user = $this->getUser($this->email, $this->password);

        if ($user) {
            session_start();
            $_SESSION["userid"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["created_at"] = $user["created_at"];

            // echo "<pre>";
            // print_r($user);
            // echo "</pre>";
        } else {
            throw new Exception("Login failed");
        }
    }

    private function emptyInput()
    {
        return !empty($this->email) && !empty($this->password);
    }
}
