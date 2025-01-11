<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $dob = $_POST['dob'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $referral_code = $_POST['referral_code'];
    $currency = $_POST['currency'];
    $investment_goal = $_POST['investment_goal'];
    $proof_of_address = $_POST['proof_of_address'];
    $two_factor = isset($_POST['enable_2fa']) ? 1 : 0;

    // Generate a 6-digit verification code
    $verification_code = rand(100000, 999999);

    // Handle file uploads
    $upload_dir = 'uploads/';
    $id_document = $upload_dir . basename($_FILES['upload_id']['name']);

    move_uploaded_file($_FILES['upload_id']['tmp_name'], $id_document);

    // Insert user into database
    $sql = "INSERT INTO users (fullname, email, phone, country, dob, username, password, referral_code, currency, investment_goal, id_document, proof_of_address, two_factor_enabled, verification_code)
            VALUES (:fullname, :email, :phone, :country, :dob, :username, :password, :referral_code, :currency, :investment_goal, :id_document, :proof_of_address, :two_factor_enabled, :verification_code)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'country' => $country,
            'dob' => $dob,
            'username' => $username,
            'password' => $password,
            'referral_code' => $referral_code,
            'currency' => $currency,
            'investment_goal' => $investment_goal,
            'id_document' => $id_document,
            'proof_of_address' => $proof_of_address,
            'two_factor_enabled' => $two_factor,
            'verification_code' => $verification_code
        ]);

        // Send verification email
        $subject = "Verify Your Email - Evestify";
        $message = "Hello $fullname,\n\nYour verification code is: $verification_code\n\nPlease enter this code to verify your email.";
        $headers = "From: no-reply@evestify.com";

        mail($email, $subject, $message, $headers);

        // Redirect to email verification page
        header("Location: verify.php?email=" . urlencode($email));
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
