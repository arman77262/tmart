<?php
require_once '../config/config.php';

class Database
{
    public $host = HOST;
    public $user = USER;
    public $password = PASS;
    public $database = DATABASE;

    public $link;
    public $error;

    public function __construct(){
        $this->dbConnect();
    }

    private function dbConnect(){
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->link){
            $this->error = "Database Connetion Faied".$this->link->connect_error;
            return false;
        }
    }

    public function select($query){
        $result = mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if (mysqli_num_rows($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function insert($query){
        $inser_row = mysqli_query($this->link, $query)  or die($this->link->error.__LINE__);
        if ($inser_row){
            return $inser_row;
        }else{
            return false;
        }
    }

    public function update($query){
        $update_row = mysqli_query($this->link, $query)  or die($this->link->error.__LINE__);
        if ($update_row){
            return $update_row;
        }else{
            return false;
        }
    }

    public function delete($query){
        $update_row = mysqli_query($this->link, $query)  or die($this->link->error.__LINE__);
        if ($update_row){
            return $update_row;
        }else{
            return false;
        }
    }
}