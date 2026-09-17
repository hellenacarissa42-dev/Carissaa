<?php

session_start();

require_once "config/database.php";

$error = "";

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


if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = md5($_POST['password']);


    $query = mysqli_query(
        $conn,
        "SELECT *
         FROM users
         WHERE email = '$email'
         AND password = '$password'
         LIMIT 1"
    );


    if (!$query) {
        die("Error database: " . mysqli_error($conn));
    }


    if (mysqli_num_rows($query) == 1) {

        $user = mysqli_fetch_assoc($query);


        // Simpan data user ke session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'role' => $user['role'],
            'akses' => $user['akses']
        ];


        // Redirect berdasarkan role

        if ($user['role'] == 'admin') {

            header("Location: admin/dashboard.php");
            exit;

        }


        if ($user['role'] == 'kasir') {

            header("Location: kasir/dashboard.php");
            exit;

        }


    } else {

        $error = "Email atau password salah.";

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - Café Coffee</title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            font-family: Arial, sans-serif;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            background:
                linear-gradient(
                    135deg,
                    #3b2418,
                    #6f4e37,
                    #a67c52
                );

        }


        .login-box {

            width: 400px;

            background: rgba(255,255,255,0.96);

            padding: 35px;

            border-radius: 20px;

            box-shadow:
                0 15px 40px
                rgba(0,0,0,0.25);

        }


        .logo {

            text-align: center;

            font-size: 55px;

            margin-bottom: 5px;

        }


        h1 {

            text-align: center;

            color: #4b2e1e;

            margin: 5px 0;

        }


        .subtitle {

            text-align: center;

            color: #777;

            margin-bottom: 30px;

        }


        .form-group {

            margin-bottom: 20px;

        }


        label {

            display: block;

            margin-bottom: 8px;

            font-weight: bold;

            color: #4b2e1e;

        }


        input {

            width: 100%;

            padding: 13px;

            border: 1px solid #ccc;

            border-radius: 10px;

            font-size: 15px;

            outline: none;

        }


        input:focus {

            border-color: #6f4e37;

            box-shadow:
                0 0 0 3px
                rgba(111,78,55,0.12);

        }


        button {

            width: 100%;

            padding: 14px;

            border: none;

            border-radius: 10px;

            background: #6f4e37;

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;

        }


        button:hover {

            background: #4b2e1e;

        }


        .error {

            background: #ffe0e0;

            color: #a00000;

            padding: 12px;

            border-radius: 8px;

            margin-bottom: 20px;

            text-align: center;

        }


        .footer {

            text-align: center;

            margin-top: 25px;

            color: #888;

            font-size: 13px;

        }

    </style>

</head>


<body>


<div class="login-box">


    <div class="logo">
        ☕
    </div>


    <h1>
        Café Coffee
    </h1>


    <div class="subtitle">
        Sistem Point of Sale
    </div>


    <?php if ($error != ""): ?>

        <div class="error">
            <?= htmlspecialchars($error); ?>
        </div>

    <?php endif; ?>


    <form method="POST">


        <div class="form-group">

            <label>
                Email
            </label>

            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
                required
            >

        </div>


        <div class="form-group">

            <label>
                Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

        </div>


        <button
            type="submit"
            name="login">

            🔐 Login

        </button>


    </form>


    <div class="footer">

        Café Coffee POS © 2026

    </div>


</div>


</body>

</html>