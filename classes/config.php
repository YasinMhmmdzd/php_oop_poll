<?php
class connection {
    private $host = "localhost";
    private $username = "root";
    private $db = "vote";
    private $psw = "";
    protected function connect(){
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db;
        $conn = new PDO($dsn,$this->username,$this->psw);
        $conn-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        return $conn;
    }
}
?>