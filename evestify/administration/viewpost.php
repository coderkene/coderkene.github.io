<?php
session_start();
require_once 'classconns/class.admin.php';
require_once 'actions/usercontrol/setup.php';
require_once 'actions/infocalc/calc.php';
require_once 'actions/blog/delete.php';
require_once 'actions/blog/edit.php';
require_once 'actions/sessiontimer/intimer.php';
require_once 'actions/logout/logout.php';
//retrieve all users
$stmt = $actionParam->runQuery("SELECT * FROM tbl_blog ORDER BY userID DESC");
$stmt->execute(array(":title"));
$postRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin View Post</title>
    <!--url icon-->
    <link rel="icon" type="image/png" href="../images/icon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    
    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    
    <!-- Page-Level CSS -->
	<link href="asset/css/bootstrap-fileupload.min.css" rel="stylesheet" />
    
    <!-- My styles -->
    <link rel="stylesheet" href="../parsley.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-cyan">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Loading data...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <?php include_once('includes/header.php'); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>VIEW POST</h2>
            </div>
            <?php if(isset($_GET['edited'])) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    The post has been successfully edited.
                </div>
            <?php } ?>
            <?php if(isset($_GET['deleted'])) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    The post has been succesfully deleted
                </div>
            <?php } ?>
            <?php if(isset($_GET['large-image-size'])) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Sorry, image size must not exceed 2MB.
                </div>
            <?php } ?>
            <?php if(isset($_GET['invalid-image-format'])) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Sorry, the image format is invalid, valid format are jpg, jpeg and png only.
                </div>
            <?php } ?>
            <?php if(isset($_GET['invalid-image-data'])) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Sorry, the image data is invalid, please upload a valid image.
                </div>
            <?php } ?>
            <?php if(isset($_GET['invalid-image-dimension'])) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Sorry, the image dimension must be width 800 x height 570.
                </div>
            <?php } ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Hello Admin,</strong> You have the privilege to perform various functions in your panel.
            </div>
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="content">
                            <div class="text">USERS</div>
                            <div class="number"><?php echo number_format($totalusers); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">credit_card</i>
                        </div>
                        <div class="content">
                            <div class="text">DEPOSITED</div>
                            <div class="number">$<?php echo number_format($totaldeposited); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">WITHDRAWN</div>
                            <div class="number">
                                <?php if(!$totalwithdrawn){ ?>
                                $0
                                <?php }else{ echo'$'; echo number_format($totalwithdrawn); } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-lime hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">pan_tool</i>
                        </div>
                        <div class="content">
                            <div class="text">PENDING</div>
                            <div class="number"><?php echo number_format($pendingwithdrawals); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL BLOG POST
                                <small>Here is a list of all the blog post.</small>
                            </h2>
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>TITLE</th>
                                        <th>TEXT</th>
                                        <th>IMAGE</th>
                                        <th>VIEWS</th>
                                        <th>DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach($postRow as $row){ ?>
                                    <tr>
                                        <th scope="row"><?php echo $count; ?></th>
                                        <td><?php echo ucfirst($row['title']); ?></td>
                                        <td><?php echo mb_strimwidth($row['text'],0,80,'...'); ?></td>
                                        <td><img src="../img/<?php echo $row['image']; ?>" height="50px" width="100px"></td>
                                        <td><?php echo ucfirst($row['views']); ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td>
                                            <button type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#me<?php echo $row['userID']; ?>"><i class="material-icons">border_color</i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#md<?php echo $row['userID']; ?>"><i class="material-icons">delete_sweep</i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
            <!-- Small Size -->
            <?php foreach($postRow as $mdrow){ ?>
            <?php $uid = base64_encode($mdrow['userID']); ?>
            <div class="modal fade" id="md<?php echo $mdrow['userID']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content modal-col-teal">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">DELETE THIS POST</h4>
                        </div>
                        <div class="modal-body">
                            <div class="image">
                              <img src="../img/<?php echo $mdrow['image']; ?>" width="48" height="48" alt="User" />
                            </div><br>
                            <span style="font-weight:700; letter-spacing:1px;"><?php echo ucfirst($mdrow['title']); ?></span><br>
                            <small><?php echo mb_strimwidth($row['text'],0,80,'...'); ?></small><br>
                            <small><?php echo ucfirst($mdrow['views']); ?></small>
                        </div>
                        <div class="modal-footer">
                            <a href="?delete&post=<?php echo $uid; ?>" class="btn btn-link waves-effect">YES DELETE</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">NO</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- #END# Small Size -->
            <!-- Large Size -->
            <?php foreach($postRow as $merow){ ?>
            <?php $uid = base64_encode($merow['userID']); ?>
            <div class="modal fade" id="me<?php echo $merow['userID']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <form action="#" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">EDIT THIS POST</h4>
                        </div>
                        <div class="modal-body">
                            <div class="image">
                              <img src="../img/<?php echo $merow['image']; ?>" width="48" height="48" alt="User" />
                            </div><br>
                            <span style="font-weight:700; letter-spacing:1px;"><?php echo ucfirst($merow['title']); ?></span><br>
                            
            <div class="block-header">
                <h2>
                    <small>You can comfortably edit this post here.</small>
                </h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                NOTICE
                                <small>You can edit any input including the image information.</small>
                            </h2>
                        </div>
                        
                        <div class="body">
                            <h2 class="card-inside-title">Basic Information</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="title" value="<?php echo $merow['title']; ?>" type="text" class="form-control" required>
                                            <label class="form-label">Title</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="text" type="text" class="form-control" required rows="10" cols="3"><?php echo $merow['text']; ?></textarea>
                                            <label class="form-label">Text</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="views" value="<?php echo $merow['views']; ?>" type="text" class="form-control" required data-parsley-pattern="^[0-9]+$">
                                            <label class="form-label">Views</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="date" value="<?php echo $merow['date']; ?>" type="text" class="form-control" required data-parsley-pattern="^[0-9/]+$">
                                            <label class="form-label">Date</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="body">
                            <h2 class="card-inside-title">Image Information</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../img/<?php echo $merow['image']; ?>" alt="" /></div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="image"></span>
                                               <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="btn-post" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <?php } ?>
            <!-- #END# Large Size -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    
    <!-- Editable Table Plugin Js -->
    <script src="plugins/editable-table/mindmup-editabletable.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/pages/tables/editable-table.js"></script>
    <script src="js/pages/ui/modals.js"></script>
    
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    
    <!-- Page-Level Plugin Scripts-->
	<script src="asset/scripts/bootstrap-fileupload.js"></script>
    
    <!-- My scripts -->
    <script src="../parsleyjs/dist/parsley.min.js"></script>
    <script>
    $(document).ready(function(){
        $('form').parsley();
    });
    </script>
</body>

</html>
