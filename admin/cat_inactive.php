<?php
require_once '../lib/Database.php';
$db = new Database();

$id = base64_decode($_GET['inactiveid']);
$query = "UPDATE `tbl_category` SET `status` = '1' WHERE `tbl_category`.`id` = '$id'";
$result = $db->update($query);
if ($result){
    header("location:manage_category.php");
}
