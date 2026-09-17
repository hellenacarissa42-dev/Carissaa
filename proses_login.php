<?php

session_start();

require_once "config/database.php";

$email = $_POST['email'];
$password = md5($_POST['password']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE email='$email'
     AND password='$password'"
);

$user = mysqli_fetch_assoc($query);

if ($user) {

    $_SESSION['user'] = $user;

    if ($user['role'] == 'admin') {

        header("Location: admin/dashboard.php");
        exit;

    } else {

        header("Location: kasir/dashboard.php");
        exit;
    }

}

header("Location: login.php?error=1");
exit;
?>