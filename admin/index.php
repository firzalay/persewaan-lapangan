<?php

require '../app/functions.php';

session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true || $_SESSION["level"] !== "admin") {
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION["login"]) && isset($_SESSION["username"])) {
    $loggedInUsername = $_SESSION["username"];
} else {
    $loggedInUsername = "";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <!-- Styling -->
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <h1><a href="index.php">JagoanFutsal</a></h1>
            </div>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="konfirmasi_sewa.php">Edit Data Sewa</a></li>
                <li><a href="riwayat_pesan.php">Riwayat Pesan</a></li>
            </ul>
        </nav>
        <div class="signin-signup">
            <ul>
                <li id="user-login">Halo <span><?= $loggedInUsername ?> </span>👋</li>
                <li class="logout"><a onclick="return confirm('Apakah anda yakin ingin logout?')" href="../app/logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

</body>

</html>