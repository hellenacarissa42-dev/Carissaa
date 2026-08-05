<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include "config/koneksi.php";

// Hitung data
$jmlProduk = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
$jmlKategori = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori"));
$jmlUser = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
$jmlTransaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Kasir</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}
.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:#0d6efd;
}
.sidebar h3{
    color:white;
    text-align:center;
    padding:20px;
}
.sidebar a{
    color:white;
    display:block;
    text-decoration:none;
    padding:15px;
}
.sidebar a:hover{
    background:white;
    color:#0d6efd;
}
.content{
    margin-left:260px;
    padding:20px;
}
.card{
    border:none;
    border-radius:15px;
}
</style>

</head>
<body>

<div class="sidebar">

<h3>APLIKASI KASIR</h3>

<a href="dashboard.php">Dashboard</a>
<a href="kategori/index.php">Kategori</a>
<a href="produk/index.php">Produk</a>
<a href="user/index.php">User</a>
<a href="transaksi/kasir.php">Kasir</a>
<a href="transaksi/riwayat.php">Riwayat</a>
<a href="laporan/index.php">Laporan</a>
<a href="logout.php">Logout</a>

</div>

<div class="content">

<h2>Dashboard</h2>

<p>Selamat datang,
<b><?php echo $_SESSION['nama']; ?></b>

(<?php echo $_SESSION['level']; ?>)

</p>

<div class="row">

<div class="col-md-3">

<div class="card shadow">

<div class="card-body">

<h5>Produk</h5>

<h1><?php echo $jmlProduk; ?></h1>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body">

<h5>Kategori</h5>

<h1><?php echo $jmlKategori; ?></h1>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body">

<h5>User</h5>

<h1><?php echo $jmlUser; ?></h1>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body">

<h5>Transaksi</h5>

<h1><?php echo $jmlTransaksi; ?></h1>

</div>

</div>

</div>

</div>

</div>

</body>
</html>