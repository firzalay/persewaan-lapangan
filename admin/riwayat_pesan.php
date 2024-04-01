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


$dataSewa = query("SELECT * FROM tb_sewa");

if (isset($_POST["search"])) {
    $dataSewa = cari($_POST["search-general"]);
} 

if (isset($_POST["cari_tanggal"])) {
    $dataSewa = cariTanggal($_POST["tanggal_pesan"]);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <!-- Styling -->
    <link rel="stylesheet" href="../css/riwayat_sewa.css">
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

    <main>
        <section>
            <h1>Riwayat Sewa</h1>

            <div class="search-option">

                <form action="" method="POST">
                    <div class="search-general">
                        <input type="text" id="search-general" name="search-general">
                        <button type="submit" name="search">Cari</button>
                    </div>
                    <div class="search-by-date">
                        <input type="date" id="tanggal_pesan" name="tanggal_pesan">
                        <button type="submit" name="cari_tanggal">Filter</button>
                    </div>
                </form>

            </div>

            <div class="table-container" style="overflow-x:auto">
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pemesan</th>
                        <th>No. Telepon</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Jam Sewa</th>
                        <th>Durasi Sewa</th>
                        <th>Kategori Lapangan</th>
                        <th>Jenis Lapangan</th>
                        <th>Sewa Sepatu</th>
                        <th>Sewa Kostum</th>
                        <th>Total Harga</th>
                    </tr>
                    <?php $i = 1 ?>
                    <?php foreach ($dataSewa as $data) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data["nama_pemesan"] ?></td>
                            <td><?= $data["no_telepon"] ?></td>
                            <td><?= date("d F Y", strtotime($data["tanggal_pesan"])) ?></td>
                            <td><?= $data["jam"] ?></td>
                            <td><?= $data["durasi_sewa"] ?></td>
                            <td><?= $data["kategori_lapangan"] ?></td>
                            <td><?= $data["jenis_lapangan"] ?></td>
                            <?php if ($data["sewa_sepatu"] == "") : ?>
                                <td>0</td>
                            <?php else : ?>
                                <td><?= $data["sewa_sepatu"] ?></td>
                            <?php endif  ?>
                            <?php if ($data["sewa_kostum"] == "") : ?>
                                <td>0</td>
                            <?php else : ?>
                                <td><?= $data["sewa_kostum"] ?></td>
                            <?php endif  ?>
                            <td><?= $data["total_bayar"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </section>
    </main>

</body>

</html>