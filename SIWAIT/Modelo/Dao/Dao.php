<?php

class Dao {

    var $servername;
    var $username;
    var $password;

    function __construct() {
        $this->servername = "sandbox2.ufps.edu.co";
        $this->username = "ufps_63";
        $this->password = "ufps_82";
    }

    public function conectar() {

        try {
            $conn = new mysqli($this->servername, $this->username, $this->password, "ufps_63");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
          //  echo "Connected successfully";

        } catch (PDOException $e) {
           //echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }

    public function getConn() {
        return $this->conn;
    }

}
