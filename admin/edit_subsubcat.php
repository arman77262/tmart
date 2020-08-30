<?php
require_once 'inc/header.php';
require_once '../classes/Category.php';

$ct = new Category();

if (!isset($_GET['editsubcat']) || $_GET['editsubcat'] == NULL){
    echo "<script>window.location='manage_subsubcategory.php'</script>";
}else{
    $cateditid = $_GET['editsubcat'];
}

if (isset($_POST['add_cat'])){
    $rootcatName = $_POST['root_cat'];
    $subcatName = $_POST['sub_cat'];
    $catName = $_POST['catName'];

    $insertCat = $ct->subsubCatUpdate($rootcatName, $subcatName, $catName, $cateditid);
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
                <li><i aria-hidden="true"></i><a href="#">Sub SubCategory</a></li>
                <li><i aria-hidden="true"></i><a href="#">Add Sub SubCategory</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp">
    <!--BASIC-->
    <div class="col-sm-12 col-md-6">
        <h4 class="section-subtitle"><b>Add Sub SubCategory</b> form</h4>
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
                            <h5 class="mb-md ">Add Sub SubCategory</h5>
                            <?php
                                $getssbyid = $ct->getAllSubSubCat($cateditid);
                                if ($getssbyid){
                                    while ($s_row = mysqli_fetch_assoc($getssbyid)){
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
                                                        <option <?=$s_row['rootcatid']==$row['id']?'selected':''?> value="<?=$row['id']?>"><?=$row['catName']?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Sub Category Name</label>
                                            <select name="sub_cat" class="form-control" id="">
                                                <option value="">Select</option>
                                                <?php
                                                $allcat = $ct->getAllSubcat();
                                                if ($allcat){
                                                    while ($row = mysqli_fetch_assoc($allcat)){
                                                        ?>
                                                        <option <?=$s_row['subcatid']==$row['scatId']?'selected':''?> value="<?=$row['scatId']?>"><?=$row['subCatName']?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Sub SubCategory Name</label>
                                            <input type="text" class="form-control" name="catName" id="email" value="<?=$s_row['sscatname']?>">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="add_cat" class="btn btn-primary">Add Sub SubCategory</button>
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