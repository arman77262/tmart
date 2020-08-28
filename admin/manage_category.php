<?php
require_once 'inc/header.php';
require_once '../classes/Category.php';
$ct = new Category();

if (isset($_GET['delcatid'])){
    $delid = $_GET['delcatid'];
    $delcat = $ct->delCatById($delid);
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
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Manage Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInRight">
            <div class="col-sm-12">
                <div class="panel b-primary bt-md">
                    <div class="row" style="padding: 10px">
                        <div class="col-xs-6">
                            <h4 class="section-subtitle"><b>Manage Category</b></h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="add_category.php" class="btn btn-success">Add Category</a>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Status btn</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        $allcat = $ct->getAllcat();
                                        if ($allcat){
                                            $sl = 1;
                                            while ($row = mysqli_fetch_assoc($allcat)){
                                                ?>
                                                <tr>
                                                    <td><?=$sl?></td>
                                                    <td><?=$row['catName']?></td>
                                                    <td><?=$row['status']==1? 'Active':'Inactive'?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['status'] == 1){
                                                            ?>
                                                            <a href="cat_active.php?activeid=<?=base64_encode($row['id'])?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-up"></i></a>
                                                            <?php

                                                        }else{
                                                            ?>
                                                            <a href="cat_inactive.php?inactiveid=<?=base64_encode($row['id'])?>" class="btn btn-sm btn-warning"><i class="fa fa-arrow-down"></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="edit_rootcat.php?editcat=<?=$row['id']?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                                        <a href="?delcatid=<?=$row['id']?>" onclick="return confirm('Are You Sure To Delete !')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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