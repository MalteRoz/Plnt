<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/RegisterModel.php';

class RegisterController extends RegisterModel
{
    private $name;
    private $email;
    private $password;
    private $passwordRepeat;
    private $street;
    private $postal;
    private $city;

    public function __construct($name, $email, $password, $passwordRepeat, $street, $postal, $city)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
        $this->street = $street;
        $this->postal = $postal;
        $this->city = $city;
    }

    public function useRegisterUser()
    {
        if ($this->emptyInput() === false) {
            header("location: ../../?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() === false) {
            header("location: ../../?error=notRegistered");
            exit();
        }
        if ($this->pwdMatch() === false) {
            header("location: ../../?error=notRegistered");
            exit();
        }
        if ($this->emailTakenCheck() === false) {
            header("location: ../../?error=notRegistered");
            exit();
        }

        $this->registerUser($this->name, $this->email, $this->password, $this->street, $this->postal, $this->city);
    }

    private function emptyInput()
    {
        if (empty($this->email) || empty($this->password) || empty($this->passwordRepeat) || empty($this->name) || empty($this->street) || empty($this->postal) || empty($this->city)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        if ($this->password !== $this->passwordRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function emailTakenCheck()
    {
        $signup = new RegisterModel();

        if ($signup->checkIfUserExists($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
