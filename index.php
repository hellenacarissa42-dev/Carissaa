<?php

session_start();

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']['role'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    }

    if ($_SESSION['user']['role'] == 'kasir') {
        header("Location: kasir/dashboard.php");
        exit;
    }
}

header("Location: login.php");
exit;

?>