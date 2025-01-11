<?php
session_start();
require_once 'classconns/class.admin.php';
require_once 'actions/usercontrol/setup.php';
require_once 'actions/infocalc/calc.php';
require_once 'actions/withdraw/withdraw.php';
require_once 'actions/sessiontimer/intimer.php';
require_once 'actions/logout/logout.php';
//retrieve all withdrawal
$stmt = $actionParam->runQuery("SELECT * FROM tbl_withdrawal ORDER BY status ASC");
$stmt->execute(array(":email"));
$withdrawalRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin Withdrawal</title>
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
                <h2>ALL WITHDRAWALS</h2>
            </div>
            <?php if(isset($_GET['marked'])) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    The withdrawal has been marked as done.
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
                                ALL WITHDRAWAL PLACED
                                <small>Here is a list of all the withdrawal users have placed so far.</small>
                            </h2>
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>FULLNAME</th>
                                        <th>EMAIL</th>
                                        <th>AMOUNT</th>
                                        <th>WALLET</th>
                                        <th>DATE</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach($withdrawalRow as $row){ ?>
                                    <?php
                                       $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
                                       $stmt->execute(array(":email"=>$row['email']));
                                       $uRow=$stmt->fetch(PDO::FETCH_ASSOC);                                    
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $count; ?></th>
                                        <td><?php echo ucfirst($uRow['fullname']); ?></td>
                                        <td><?php echo ucfirst($row['email']); ?></td>
                                        <td>$<?php echo number_format($row['amount']); ?></td>
                                        <td><?php echo $uRow['wallet_address']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td>
                                            <?php if($row['status']==0){ ?>
                                            <button type="button" class="btn bg-green btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#md<?php echo $row['userID']; ?>"><i class="material-icons">done_all</i>
                                            </button>
                                            <?php }else{ ?>
                                            <button type="button" class="btn bg-grey btn-circle waves-effect waves-circle waves-float" ><i class="material-icons">done_all</i>
                                            </button>
                                            <?php } ?>
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
            <?php foreach($withdrawalRow as $mdrow){ ?>
            <?php
                 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
                 $stmt->execute(array(":email"=>$mdrow['email']));
                 $uRow=$stmt->fetch(PDO::FETCH_ASSOC);                                    
            ?>
            <?php $uid = base64_encode($mdrow['userID']); ?>
            <div class="modal fade" id="md<?php echo $mdrow['userID']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content modal-col-teal">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">MARK WITHDRAWAL AS DONE</h4>
                        </div>
                        <div class="modal-body">
                            <div class="image">
                              <img src="images/user.png" width="48" height="48" alt="User" />
                            </div><br>
                            <span style="font-weight:700; letter-spacing:1px;"><?php echo ucfirst($uRow['fullname']); ?></span><br>
                            <small><?php echo ucfirst($mdrow['email']); ?></small><br>
                            <small><?php echo ucfirst($uRow['phone']); ?></small><br>
                            <small style="font-weight:700;">$<?php echo number_format($mdrow['amount']); ?></small>
                        </div>
                        <div class="modal-footer">
                            <a href="?mark&id=<?php echo $uid; ?>" class="btn btn-link waves-effect">YES MARK</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">NO</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- #END# Small Size -->
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
