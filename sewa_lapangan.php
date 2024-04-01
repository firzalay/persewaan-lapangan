<?php

require 'app/functions.php';

session_start();

if (isset($_SESSION["login"]) && isset($_SESSION["username"])) {
    $loggedInUsername = $_SESSION["username"];
} else {
    $loggedInUsername = '';
}

if (!isset($_SESSION["login"])) {   
    header("Location: index.php");
}


if (isset($_POST["pesan"])) {
    if (pesan($_POST) > 0) {
        echo "<script>alert('Pesan Lapangan Berhasil!')
        document.location.href='data_sewa.php'</script>";
    } else {
        echo "<script>alert('Pesan Lapangan Gagal!')
        document.location.href='data_sewa.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sewa_lapangan.css">
    <!-- Google fonts -->
    <title>Sewa Lapangan</title>
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
                <li><a href="data_sewa.php">Data Sewa</a></li>
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
        <section>
            <h1>Sewa Lapangan</h1>
            <form action="" method="POST">
                <div class="row-1">
                    <input type="text" id="nama_pemesan" name="nama_pemesan" placeholder="Nama Pemesan" required>
                    <input type="text" id="no_telepon" name="no_telepon" placeholder="No Telepon">
                </div>
                <div class="row-2">
                    <div class="col-1">
                        <label for="tanggal_pesan">Tanggal Pemesanan</label>
                        <input type="date" id="tanggal_pesan" name="tanggal_pesan" required>
                    </div>

                    <div class="col-2">
                        <label for="jam_sewa">Jam Sewa</label>
                        <input type="time" id="jam_sewa" name="jam_sewa" required>
                    </div>

                    <div class="col-3">
                        <label for="durasi_sewa">Durasi Sewa Per Jam</label>
                        <input type="number" id="durasi_sewa" name="durasi_sewa" min="1" required>
                    </div>
                </div>
                <div class="row-3">
                    <label for="kategori_lapangan">Kategori Lapangan</label>
                    <select name="kategori_lapangan" id="kategori_lapangan" required>
                        <option value="Indoor">Indoor</option>
                        <option value="Outdoor">Outdoor</option>
                    </select>
                </div>
                <div class="row-4">
                    <label for="jenis_lapangan">Jenis Lapangan</label>
                    <select name="jenis_lapangan" id="jenis_lapangan" required>
                        <option value="Reguler">Reguler</option>
                        <option value="Matras">Matras</option>
                        <option value="Rumput">Rumput</option>
                    </select>
                </div>
                <div class="row-5">
                    <div class="col-1">
                        <label for="sewa_kostum">Sewa Kostum (Optional)</label>
                        <input type="number" id="sewa_kostum" name="sewa_kostum" min="1" placeholder="Jumlah Per Orang">
                    </div>
                    <div class="col-2">
                        <label for="sewa_sepatu">Sewa Sepatu (Optional)</label>
                        <input type="number" id="sewa_sepatu" name="sewa_sepatu" min="1" placeholder="Jumlah Per Orang">
                    </div>
                </div>
                <div class="row-6">
                    <div class="col-1">
                        <label for="bayar">Bayar</label>
                        <input type="text" id="bayar" name="bayar">
                    </div>
                    <div class="col-2">
                        <label for="total_bayar">Total Harga</label>
                        <input type="text" id="total_bayar" name="total_bayar" readonly>
                    </div>
                </div>
                <div class="row-7">
                    <label for="uang_kembali">Uang Kembali</label>
                    <input type="text" id="uang_kembali" name="uang_kembali" readonly>
                </div>
                <button type="submit" name="pesan">Pesan</button>
            </form>
        </section>
    </main>

    <script src="js/priceCalculation.js"></script>
</body>

</html>