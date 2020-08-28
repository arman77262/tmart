<?php
require_once 'inc/header.php';
require_once '../classes/Category.php';
$ct = new Category();

if (isset($_GET['delsubcatid'])){
    $delsubid = $_GET['delsubcatid'];
    $delid = $ct->delSubCat($delsubid);
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
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Manage Sub Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInRight">
            <div class="col-sm-12">
                <div class="panel b-primary bt-md">
                    <div class="row" style="padding: 10px">
                        <div class="col-xs-6">
                            <h4 class="section-subtitle"><b>Manage Sub Category</b></h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="add_subcategory.php" class="btn btn-success">Add Sub Category</a>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Root Category</th>
                                        <th>Sub Category</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $allcat = $ct->getAllSubcat();
                                    if ($allcat){
                                        $sl = 1;
                                        while ($row = mysqli_fetch_assoc($allcat)){
                                            ?>
                                            <tr>
                                                <td><?=$sl?></td>
                                                <td><?=$row['catName']?></td>
                                                <td><?=$row['subCatName']?></td>
                                                <td>
                                                    <a href="edit_subcat.php?editsubcat=<?=$row['scatId']?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                                    <a href="?delsubcatid=<?=$row['scatId']?>" onclick="return confirm('Are You Sure To Delete !')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $sl++;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php require_once 'inc/footer.php';?>