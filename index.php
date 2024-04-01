<?php

session_start();

if (isset($_SESSION["login"]) && isset($_SESSION["username"])) {
    $loggedInUsername = $_SESSION['username'];
} else {
    $loggedInUsername = '';
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Jagoan Futsal</title>
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Noto+Sans+Mono:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <h1><a href="index.php">JagoanFutsal</a></h1>
            </div>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <?php if (isset($_SESSION["login"])) : ?>
                    <li><a href="sewa_lapangan.php">Sewa Lapangan</a></li>
                <?php else : ?>
                    <li><a href="" onclick="alert('Login terlebih dahulu!')">Sewa Lapangan</a></li>
                <?php endif ?>
                <li><a href="tentang_kami.php">Tata Cara Sewa</a></li>
            </ul>
        </nav>
        <div class="signin-signup">
            <ul>
                <?php if (isset($_SESSION["login"])) : ?>
                    <li id="user-login">Halo <span><?= $loggedInUsername ?> </span>👋</li>
                    <li class="logout"><a onclick="return confirm('Apakah anda yakin ingin logout?')" href="app/logout.php">Logout</a></li>
                <?php else : ?>
                    <li class="sign-up"><a href="register.php">Sign Up</a></li>
                    <li class="sign-in"><a href="login.php">Sign In</a></li>
                <?php endif ?>
            </ul>
        </div>
    </header>

    <main>
        <section class="landing-page">
            <div class="headline">
                <h1>Sewa Lapangan Futsal <span>Dengan Kami Si <strong>Jagoan Futsal</strong></span></h1>
                <p>Jagoan Futsal memberikan pengalaman menyewa lapangan futsal <span>dengan mudah dan cepat, segera sewa lapangan terbaik untuk anda</span></p>
                <div class="landing-page-button">
                    <?php if (isset($_SESSION["login"])) : ?>
                        <a href="sewa_lapangan.php">Sewa Sekarang!</a>
                    <?php else :  ?>
                        <a onclick="alert('Login terlebih dahulu!')" href="sewa_lapangan.php">Sewa Sekarang!</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="landing-page-images">
                <img src="images/black-white-futsal.jpeg" alt="Futsal Photo">
            </div>
        </section>

    </main>


</body>

</html>