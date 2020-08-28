<?php
    require_once '../lib/Session.php';
    Session::loginCheck();
    require_once '../lib/Database.php';
    require_once '../helpers/Format.php';

class AdminLogin
{
    public $db;
    public $fr;

    public function __construct(){
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function adminLogin($email, $password){
        $email = $this->fr->validation($email);
        $password = $this->fr->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($email) || empty($password)) {
            $loginMsg = "Email or password Fild must not be empty";
            return $loginMsg;
        }else{
            $query = "SELECT * FROM tbl_admin WHERE adminEmail='$email' AND adminPass = '$password'";
            $result = $this->db->select($query);
            if ($result !=false){
                $row = mysqli_fetch_assoc($result);
                Session::set('login', true);
                Session::set('adminId', $row['adminId']);
                Session::set('adminUser', $row['adminUser']);
                Session::set('adminName', $row['adminName']);
                header("location:index.php");
            }else{
                $loginMsg = "Username Or Password Not Match";
                return $loginMsg;
            }
        }
    }
}