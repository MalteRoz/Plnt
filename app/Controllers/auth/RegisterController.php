<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/RegisterModel.php';

class RegisterController extends RegisterModel
{
    private $userData;

    public function __construct(array $data)
    {
        $this->userData = $data;
    }

    public function useRegisterUser()
    {
        if ($this->checkIfUserExists($this->userData['email'])) {

            return false;
        }

        $this->registerUser(
            $this->userData['name'],
            $this->userData['email'],
            $this->userData['pswrd'],
            $this->userData['adress'],
            $this->userData['postcode'],
            $this->userData['city']
        );
        return true;
    }
}
