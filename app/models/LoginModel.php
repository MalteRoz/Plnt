<?php
class LoginModel extends Dbh
{
    protected function getUser($email, $password)
    {
        $sql = "SELECT * FROM customers WHERE email = ?;";
        $stmt = $this->connection()->prepare($sql);

        if (!$stmt->execute([$email])) {
            throw new Exception("Database statement failed");
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user || !password_verify($password, $user["password"])) {
            throw new Exception("Login failed");
        }

        return $user;
    }
}

//testtest1234