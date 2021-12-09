<?php

class Database {

    private $host = 'localhost';
    private $login = 'root';
    private $password = 'root';
    private $db_name = 'db_for_tests';

    private $link;

    public function __construct() {
        $this->link = mysqli_connect($this->host, $this->login, $this->password);
        $this->init_db();
        $this->query('CREATE TABLE IF NOT EXISTS users (
            serial int NOT NULL AUTO_INCREMENT,
            user_name varchar(255),
            access_token varchar(255),
            refresh_token varchar(255),
            expires_in int,
            PRIMARY KEY (serial)
        )');
    }

    private function init_db() {
        if (!mysqli_select_db($this->link, $this->db_name)) {
            $this->link->query('CREATE DATABASE ' . $this->db_name);
            mysqli_select_db($this->link, $this->db_name);
        }
        return true;
    }

    public function query($query) {
        return $this->link->query($query);
    }
}