<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/database/dbh.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/models/RegisterModel.php';

class RegisterController
{
    private $userData;
    private $registerModel;

    public function __construct(array $data)
    {
        $this->userData = $data;
        $this->registerModel = new RegisterModel();
    }

    public function useRegisterUser()
    {
        if ($this->registerModel->checkIfUserExists($this->userData['email'])) {

            return false;
        }

        $this->registerModel->registerUser(
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
