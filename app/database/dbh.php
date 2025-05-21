<?php

// require_once $_SERVER['DOCUMENT_ROOT'] . '/Plnt/vendor/autoload.php';


class Dbh
{
    private $host;
    private $db_name;
    private $username;
    private $password;

    public function __construct()
    {

        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    protected function connection()
    {

        try {
            $host = $this->host;
            $db_name = $this->db_name;
            $username = $this->username;
            $password = $this->password;

            $dsn = "mysql:host=" . $host . ";dbname=" . $db_name;
            // echo "USERNAME: " . var_export($username, true) . "<br>";
            // echo "PASSWORD: " . var_export($password, true) . "<br>";
            // echo "USERNAME: " . var_dump($_ENV['DB_USERNAME']) . "<br>";
            // echo "PASSWORD: " . var_dump($_ENV['DB_PASSWORD']) . "<br>";
            // echo "USERNAME: " . $username . "<br>";
            // echo "PASSWORD: " . $password . "<br>";

            $dbh = new PDO($dsn, $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }
}
