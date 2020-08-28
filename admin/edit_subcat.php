<?php
require_once 'inc/header.php';
require_once '../classes/Category.php';

$ct = new Category();

if (!isset($_GET['editsubcat']) || $_GET['editsubcat'] == NULL){
    echo "<script>window.location='manage_category.php'</script>";
}else{
    $cateditid = $_GET['editsubcat'];
}


if (isset($_POST['update_cat'])){
    $rootcatName = $_POST['root_cat'];
    $catName = $_POST['catName'];

    $insertCat = $ct->subCatUpdate($rootcatName, $catName,$cateditid);
}
?>
    <!-- CONTENT -->
    <!-- ========================================================= -->
    <div class="content">
    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                <li><i aria-hidden="true"></i><a href="#">Sub Category</a></li>
                <li><i aria-hidden="true"></i><a href="#">Edit Sub Category</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp">
    <!--BASIC-->
    <div class="col-sm-12 col-md-6">
        <h4 class="section-subtitle"><b>Edit Category</b> form</h4>
        <?php
        if (isset($insertCat)){
            ?>
            <div class="alert alert-success" role="alert">
                <?=$insertCat?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <h5 class="mb-md ">Edit Category</h5>
                            <?php
                                $select_rootcat = $ct->getSubCatById($cateditid);
                                if ($select_rootcat){
                                    while ($catrow = mysqli_fetch_assoc($select_rootcat)){
                                        ?>
                                        <div class="form-group">
                                            <label for="email">Root Category Name</label>
                                            <select name="root_cat" class="form-control" id="">
                                                <option value="">Select</option>
                                                <?php
                                                $allcat = $ct->getAllcat();
                                                if ($allcat){
                                                    while ($row = mysqli_fetch_assoc($allcat)){
                                                        ?>
                                                        <option <?=$catrow['rootcatId'] == $row['id']? 'selected':''?> value="<?=$row['id']?>"><?=$row['catName']?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Sub Category Name</label>
                                            <input type="text" class="form-control" name="catName" id="email" value="<?=$catrow['subCatName']?>">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="update_cat" class="btn btn-primary">Update Category</button>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'inc/footer.php';?>