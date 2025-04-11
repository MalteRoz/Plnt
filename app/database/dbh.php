<?php
class Dbh
{
    private $host = "localhost";
    private $db_name = "plnt";
    private $username = "root";
    private $password = "";

    protected function connection()
    {

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $dbh = new PDO($dsn, $this->username, $this->password);
            return $dbh;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }
}
