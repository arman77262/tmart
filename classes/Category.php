<?php
require_once '../lib/Database.php';
require_once '../helpers/Format.php';

class Category
{
    public $db;
    public $fr;

    public function __construct(){
        $this->db = new Database();
        $this->fr = new Format();
    }

    //Root Category Start

    //Insert Root Category
    public function catInsert($catName){
        $catName = $this->fr->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)){
            $catMsg = "<span class='text-danger'><b>Category name Fild Must Not Be Empty</b></span>";
            return $catMsg;
        }else{
            $query = "INSERT INTO `tbl_category`(`catName`) VALUES ('$catName')";
            $insercat = $this->db->insert($query);
            if ($insercat){
                $catMsg = "Category Inseted Successfully";
                return $catMsg;
            }else{
                $catMsg = "<span class='text-danger'><b>Category is Not Inseted</b></span>";
                return $catMsg;
            }
        }
    }

    //Select Alls Root Category in manage_category page
    public function getAllcat(){
        $query = "SELECT * FROM tbl_category ORDER BY id ASC ";
        $allcat = $this->db->select($query);
        return $allcat;
    }

    //Select Root Category in update page
    public function getCatById($id){
        $query = "SELECT * FROM tbl_category WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    //Update Root Category
    public function catUpdate($catName, $id){
        $catName = $this->fr->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)){
            $catMsg = "<span class='text-danger'><b>Category name Fild Must Not Be Empty</b></span>";
            return $catMsg;
        }else{
            $query = "UPDATE `tbl_category` SET `catName`='$catName' WHERE `id`='$id'";
            $insercat = $this->db->update($query);
            if ($insercat){
                $catMsg = "Category Update Successfully";
                return $catMsg;
            }else{
                $catMsg = "<span class='text-danger'><b>Category is Not Update</b></span>";
                return $catMsg;
            }
        }
    }

    //Delete Root Category
    public function delCatById($id){
        $query = "DELETE FROM `tbl_category` WHERE `id`='$id'";
        $result = $this->db->delete($query);
        if ($result){
            echo "<script>window.location='manage_category.php'</script>";
        }else{

        }
    }

    //Root Category End


    //Start Sub Category

    public function subCatInsert($rootcat, $subcat){
        $rootcat = $this->fr->validation($rootcat);
        $subcat = $this->fr->validation($subcat);

        $rootcat = mysqli_real_escape_string($this->db->link, $rootcat);
        $subcat = mysqli_real_escape_string($this->db->link, $subcat);

        if (empty($rootcat) || empty($subcat)){
            $subcatmsg = "<span class='text-danger'>Those Fild Are Must Not Be Empty</span>";
            return $subcatmsg;
        }else{
            $query = "INSERT INTO `tbl_subcategory`(`rootcatId`, `subCatName`) VALUES ('$rootcat', '$subcat')";
            $insersubcat = $this->db->insert($query);
            if ($insersubcat){
                $subcatmsg = "Category Inseted Successfully";
                return $subcatmsg;
            }else{
                $subcatmsg = "<span class='text-danger'><b>Category is Not Inseted</b></span>";
                return $subcatmsg;
            }
        }
    }

    public function getAllSubcat(){
        $query = "SELECT tbl_subcategory.*, tbl_category.catName FROM tbl_subcategory INNER JOIN tbl_category
ON tbl_subcategory.rootcatId = tbl_category.id";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSubCatById($id){
        $query = "SELECT tbl_subcategory.*, tbl_category.catName FROM tbl_subcategory INNER JOIN tbl_category
ON tbl_subcategory.rootcatId = tbl_category.id WHERE tbl_subcategory.scatId = '$id'";
        $select_cat = $this->db->select($query);
        return $select_cat;
    }

    public function subCatUpdate($rootcat, $subcat, $id){
        $rootcat = $this->fr->validation($rootcat);
        $subcat = $this->fr->validation($subcat);

        $rootcat = mysqli_real_escape_string($this->db->link, $rootcat);
        $subcat = mysqli_real_escape_string($this->db->link, $subcat);

        if (empty($rootcat) || empty($subcat)){
            $subcatmsg = "<span class='text-danger'>Those Fild Are Must Not Be Empty</span>";
            return $subcatmsg;
        }else{
            $query = "UPDATE `tbl_subcategory` SET `rootcatId`='$rootcat',`subCatName`='$subcat' WHERE `scatId`= '$id'";
            $updatesubcat = $this->db->insert($query);
            if ($updatesubcat){
                $subcatmsg = "Category Update Successfully";
                return $subcatmsg;
            }else{
                $subcatmsg = "<span class='text-danger'><b>Category is Not Updated</b></span>";
                return $subcatmsg;
            }
        }
    }

    public function delsubcat($id){
        $query = "DELETE FROM `tbl_subcategory` WHERE `scatId`='$id'";
        $result = $this->db->delete($query);
        if ($result){
            echo "<script>window.location='manage_subcategory.php'</script>";
        }else{

        }
    }
}
