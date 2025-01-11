<?php
session_start();
require_once 'classconns/class.admin.php';
require_once 'actions/usercontrol/setup.php';
require_once 'actions/infocalc/calc.php';
require_once 'actions/users/delete.php';
require_once 'actions/users/edit.php';
require_once 'actions/sessiontimer/intimer.php';
require_once 'actions/logout/logout.php';
//retrieve all users
$stmt = $actionParam->runQuery("SELECT * FROM tbl_user ORDER BY userID DESC");
$stmt->execute(array(":email"));
$allusersRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin Registered Users</title>
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
                <h2>ALL USERS</h2>
            </div>
            <?php if(isset($_GET['edited'])) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    The user has been successfully edited.
                </div>
            <?php } ?>
            <?php if(isset($_GET['deleted'])) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    The user has been succesfully deleted
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
                                ALL REGISTERED USERS
                                <small>Here is a list of all the users registered on your website. Only necessary information are displayed.</small>
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
                                        <th>REF-EMAIL</th>
                                        <th>WALLET</th>
                                        <th>BALANCE</th>
                                        <th>STATE</th>
                                        <th>COUNTRY</th>
                                        <th>PHONE</th>
                                        <th>DATE</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach($allusersRow as $row){ ?>
                                    <tr>
                                        <th scope="row"><?php echo $count; ?></th>
                                        <td><?php echo ucfirst($row['fullname']); ?></td>
                                        <td><?php echo ucfirst($row['email']); ?></td>
                                        <td><?php echo ucfirst($row['ref_email']); ?></td>
                                        <td><?php echo $row['wallet_address']; ?></td>
                                        <td>$<?php echo number_format($row['balance']); ?></td>
                                        <td><?php echo ucfirst($row['state']); ?></td>
                                        <td><?php echo ucfirst($row['country']); ?></td>
                                        <td><?php echo $row['phone']; ?></td>
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
            <?php foreach($allusersRow as $mdrow){ ?>
            <?php $uid = base64_encode($mdrow['userID']); ?>
            <div class="modal fade" id="md<?php echo $mdrow['userID']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content modal-col-teal">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">DELETE THIS USER</h4>
                        </div>
                        <div class="modal-body">
                            <div class="image">
                              <img src="images/user.png" width="48" height="48" alt="User" />
                            </div><br>
                            <span style="font-weight:700; letter-spacing:1px;"><?php echo ucfirst($mdrow['fullname']); ?></span><br>
                            <small><?php echo ucfirst($mdrow['email']); ?></small><br>
                            <small><?php echo ucfirst($mdrow['phone']); ?></small>
                        </div>
                        <div class="modal-footer">
                            <a href="?delete&user=<?php echo $uid; ?>" class="btn btn-link waves-effect">YES DELETE</a>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">NO</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- #END# Small Size -->
            <!-- Large Size -->
            <?php foreach($allusersRow as $merow){ ?>
            <?php $uid = base64_encode($merow['userID']); ?>
            <div class="modal fade" id="me<?php echo $merow['userID']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <form action="#" method="post" role="form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">EDIT THIS USER</h4>
                        </div>
                        <div class="modal-body">
                            <div class="image">
                              <img src="images/user.png" width="48" height="48" alt="User" />
                            </div><br>
                            <span style="font-weight:700; letter-spacing:1px;"><?php echo ucfirst($merow['fullname']); ?></span><br>
                            
            <div class="block-header">
                <h2>
                    <small>You can comfortably edit <?php echo ucfirst($merow['fullname']); ?>'s data here.</small>
                </h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                NOTICE
                                <small>You can edit any input including the security information.</small>
                            </h2>
                        </div>
                        
                        <div class="body">
                            <h2 class="card-inside-title">Basic Information</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="fullname" value="<?php echo ucfirst($merow['fullname']); ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z ]+$">
                                            <label class="form-label">Fullname</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="email" value="<?php echo ucfirst($merow['email']); ?>" type="email" class="form-control" data-parsley-type="email">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="refemail" value="<?php echo ucfirst($merow['ref_email']); ?>" type="email" class="form-control" data-parsley-type="email">
                                            <label class="form-label">Referrer's email</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="date" value="<?php echo $merow['date']; ?>" type="text" class="form-control" data-parsley-pattern="^[0-9/]+$">
                                            <label class="form-label">Date</label>
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
                                            <input name="phone" value="<?php echo $merow['phone']; ?>" type="text" class="form-control" data-parsley-pattern="^[0-9]+$">
                                            <label class="form-label">Tel</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="state" value="<?php echo ucfirst($merow['state']); ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z ]+$">
                                            <label class="form-label">State</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                             <input name="country" value="<?php echo ucfirst($merow['country']); ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z ]+$">
                                            <label class="form-label">Country</label>
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
                                            <input name="wallet" value="<?php echo $merow['wallet_address']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Wallet address</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="receive" value="<?php echo $merow['address_given']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">BTC address</label>
                                        </div>
                                        <br/>
                                        <div class="form-line">
                                            <input name="ltcadd" value="<?php echo $merow['ltc_given']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Litecoin address</label>
                                        </div>
                                        <br/>
                                        <div class="form-line">
                                            <input name="ethadd" value="<?php echo $merow['eth_given']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Ethereum address</label>
                                        </div>
                                        <br/>
                                        <div class="form-line">
                                            <input name="usdtadd" value="<?php echo $merow['usdt_given']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Usdt address</label>
                                        </div>
                                        <br/>
                                        <div class="form-line">
                                            <input name="bnbadd" value="<?php echo $merow['bnb_given']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">BNB address</label>
                                        </div><br/>
                                        <div class="form-line">
                                            <input name="profit" value="<?php echo $merow['profit']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Profit</label>
                                        </div><br/>
                                         <div class="form-line">
                                            <input name="profit_total" value="<?php echo $merow['profit_total']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Total Profit</label>
                                        </div>
                                        <br/>
                                         <div class="form-line">
                                            <input name="lastdeposite" value="<?php echo $merow['last_deposite']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Last Deposit</label>
                                        </div>
                                        <br/>
                                        <div class="form-line">
                                            <input name="verification" value="<?php echo $merow['verification']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Verification</label>
                                        </div>
                                        <br/>
                                         <div class="form-line">
                                            <input name="lastwithdraw" value="<?php echo $merow['last_withdrawal']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                                            <label class="form-label">Last withdraw</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="bal" value="<?php echo $merow['balance']; ?>" type="text" class="form-control" data-parsley-pattern="^[0-9]+$">
                                            <label class="form-label">Account balance</label>
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
                                            <input name="pass" value="<?php echo $merow['password']; ?>" type="text" class="form-control" data-parsley-pattern="^[a-zA-Z0-9]+$">
                              
                                            <label class="form-label">Password</label>
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
                            <button type="submit" name="btn-save" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
    <!-- My scripts -->
    <script src="../parsleyjs/dist/parsley.min.js"></script>
    <script>
    $(document).ready(function(){
        $('form').parsley();
    });
    </script>
</body>

</html>
