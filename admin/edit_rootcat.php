<?php
require_once 'inc/header.php';
require_once '../classes/Category.php';

$ct = new Category();

if (!isset($_GET['editcat']) || $_GET['editcat'] == NULL){
    echo "<script>window.location='manage_category.php'</script>";
}else{
    $cateditid = $_GET['editcat'];
}

if (isset($_POST['update_cat'])){
    $catName = $_POST['catName'];

    $updateCat = $ct->catUpdate($catName, $cateditid);
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
                <li><i aria-hidden="true"></i><a href="#">Category</a></li>
                <li><i aria-hidden="true"></i><a href="#">Add Category</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp">
    <!--BASIC-->
    <div class="col-sm-12 col-md-6">
        <h4 class="section-subtitle"><b>Add Category</b> form</h4>
        <?php
        if (isset($updateCat)){
            ?>
            <div class="alert alert-success" role="alert">
                <?=$updateCat?>
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
                        <?php
                            $catid = $ct->getCatById($cateditid);
                            if ($catid){
                                while ($row = mysqli_fetch_assoc($catid)){
                                    ?>
                                    <form action="" method="post">
                                        <h5 class="mb-md ">Add Category</h5>
                                        <div class="form-group">
                                            <label for="email">Category Name</label>
                                            <input type="text" class="form-control" name="catName" id="email" value="<?=$row['catName']?>">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="update_cat" class="btn btn-primary">Update Category</button>
                                        </div>
                                    </form>
                                    <?php
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'inc/footer.php';?>