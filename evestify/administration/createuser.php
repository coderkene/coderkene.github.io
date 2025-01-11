<?php
session_start();
require_once 'classconns/class.admin.php';
require_once 'actions/usercontrol/setup.php';
require_once 'actions/infocalc/calc.php';
require_once 'actions/users/create.php';
require_once 'actions/sessiontimer/intimer.php';
require_once 'actions/logout/logout.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin Create User</title>
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

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    
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
                <h2>CREATE USER</h2>
            </div>
            <?php if(isset($msg)) echo $msg; ?>
            <?php if(isset($_GET['created'])) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    The user has been created successfully.
                </div>
            <?php } ?>
            <?php if(isset($_GET['referral-email-error'])) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Sorry, the referral email does not exist.
                </div>
            <?php } ?>
            <?php if(isset($_GET['register-email-error'])) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Sorry, the email already exist.
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
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                USER DETAILS
                                <small>You can create a new user here, enter the user details.</small>
                            </h2>
                        </div>
                        <form action="#" method="post" role="form">
                        <div class="body">
                            <h2 class="card-inside-title">Basic Information</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="fullname" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z ]+$">
                                            <label class="form-label">Fullname</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="email" type="email" class="form-control" data-parsley-type="email">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="refemail" type="email" class="form-control" data-parsley-type="email">
                                            <label class="form-label">Referrer</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Account Information</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="wallet" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Wallet address</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="bal" type="text" class="form-control" data-parsley-pattern="^[0-9]+$">
                                            <label class="form-label">Account balance</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Contact Information</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="state" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z ]+$">
                                            <label class="form-label">State</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="country" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z ]+$">
                                            <label class="form-label">Country</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="phone" type="text" class="form-control" data-parsley-pattern="^[0-9]+$">
                                            <label class="form-label">Mobile number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="body">
                            <h2 class="card-inside-title">Security Information</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="password" type="password" class="form-control" id="passwd" data-parsley-length="[8, 30]" data-parsley-pattern="^[a-zA-Z0-9]+$" data-parsley-trigger="keyup">
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="password" type="password" class="form-control" equalto="#passwd" data-parsley-length="[8, 30]" data-parsley-pattern="^[a-zA-Z0-9]+$" data-parsley-trigger="keyup">
                                            <label class="form-label">Retype password</label>
                                        </div>
                                    </div>
                                    <button name="btn-create" type="submit" class="btn bg-cyan waves-effect">SAVE</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
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
    <!-- My scripts -->
    <script src="../parsleyjs/dist/parsley.min.js"></script>
    <script>
    $(document).ready(function(){
        $('form').parsley();
    });
    </script>
</body>

</html>
