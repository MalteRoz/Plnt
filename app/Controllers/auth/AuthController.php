<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/utils/Validator.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/Controllers/auth/RegisterController.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/Controllers/auth/LoginController.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Plnt/app/utils/Flash.php';


class AuthController
{
    public function showLogin()
    {
        require view('Login.view.php');
    }

    public function showSignup()
    {
        require view('Signup.view.php');
    }

    public function signup()
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["pswrd"];
        $passwordRepeat = $_POST["pswrd-rep"];
        $street = $_POST["adress"];
        $city = $_POST["city"];
        $postal = $_POST["postcode"];

        $userData = [
            'name' => $name,
            'email' => $email,
            'pswrd' => $password,
            'pswrd-rep' => $passwordRepeat,
            'adress' => $street,
            'postcode' => $postal,
            'city' => $city
        ];


        $v = new Validator($_POST);
        $register = new RegisterController($userData);


        $v->field('name')->required()->alpha([' '])->min_len(2)->max_len(50);
        $v->field('email')->required()->email()->min_len(6)->max_len(50);
        $v->field('pswrd')->required()->alpha_num(['!@#$%&/\=*<>-_:;,."£'])->min_len(8)->max_len(20);
        $v->field('pswrd-rep')->required()->equals($password);
        $v->field('adress')->required()->alpha_num([' '])->min_len(5)->max_len(50);
        $v->field('city')->required()->alpha([' '])->min_len(2)->max_len(50);
        $v->field('postcode')->required()->numeric()->min_len(3)->max_len(10);

        if ($v->is_valid()) {
            try {
                $response = $register->useRegisterUser();

                if ($response === true) {
                    Flash::set('success', 'Account created');
                } else {
                    Flash::set('error', 'Something went wrong while creating your account 1');
                }
            } catch (Exception $e) {
                Flash::set('error', 'Something went wrong while creating your account 2');
            }
        } else {
            $errors = [];
            foreach ($_POST as $key => $value) {
                $msg = $v->get_error_message($key);
                if ($msg !== "") {
                    $errors[$key] = $msg;
                }
            }

            Flash::set('error', 'We were unable to validate your information, please try again.');

            // $_SESSION['response'] = [
            //     'status' => 'error',
            //     'message' => 'Something went wrong while creating your account',
            //     'validation_errors' => $errors
            // ];
            $_SESSION['validation_errors'] = $errors;

            $_SESSION['old_input'] = $_POST;
        }

        header("Location: /plnt/signup");
        exit();
    }

    public function login()
    {
        $email = $_POST["email"];
        $password = $_POST["pswrd"];
        $login = new LoginController($email, $password);

        try {
            $login->loginUser();
            $login->loginUser();
            Flash::set('success', 'You are logged in');
            header("Location: /plnt/account");
        } catch (Exception $e) {
            Flash::set('error', $e->getMessage());
            header("Location: /plnt/login");
        }


        exit();
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();

        header("Location: /plnt/login");
        // require view("Login.view.php");
        exit();
    }
}
