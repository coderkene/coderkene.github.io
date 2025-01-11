<?php
require 'db.php';
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $verification_code = $_POST['verification_code'];

    // Check if the code matches
    $sql = "SELECT * FROM users WHERE email = :email AND verification_code = :verification_code";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'verification_code' => $verification_code]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Update verification status
        $sql = "UPDATE users SET is_verified = 1 WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);

        echo "Email verified successfully! You can now <a href='../login.php'>login</a>.";
    } else {
        echo "Invalid verification code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Email Verification - Evestify</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../account/vendors/feather/feather.css">
  <link rel="stylesheet" href="../account/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../account/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../account/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.svg" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <a href="../index.html"><img src="../images/logo.svg" alt="logo"></a>
              </div>
              <h4>Email Verification</h4>
              <h6 class="font-weight-light">Input the code from your email.</h6>
              <form class="pt-3" action="verify.php" method="POST">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                <div class="form-group">
                    <label>Enter Verification Code</label>
                    <input type="text" class="form-control form-control-lg" placeholder="code" name="verification_code" required>
                </div>
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Verify</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../account/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../account/js/off-canvas.js"></script>
  <script src="../account/js/hoverable-collapse.js"></script>
  <script src="../account/js/template.js"></script>
  <script src="../account/js/settings.js"></script>
  <script src="../account/js/todolist.js"></script>
  <!-- endinject -->
</body>
</html>
