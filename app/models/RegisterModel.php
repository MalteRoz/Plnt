<?php

class RegisterModel extends Dbh
{
    protected function createUser($name, $email, $password, $street, $postal, $city)
    {
        $sql = "INSERT INTO customers (name, email, password, street_adress, postcode, city) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $this->connection()->prepare($sql);

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($name, $email, $hashedPwd, $street, $postal, $city))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function getUser($email)
    {
        $sql = "SELECT * FROM customers WHERE email = ? LIMIT 1;";
        $stmt = $this->connection()->prepare($sql);
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkIfUserExists($email)
    {
        $user = $this->getUser($email);
        return $user !== false;
    }

    public function registerUser($name, $email, $password, $street, $postal, $city)
    {
        return $this->createUser($name, $email, $password, $street, $postal, $city);
    }
}
