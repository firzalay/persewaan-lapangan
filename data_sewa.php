<?php

require 'app/functions.php';

session_start();

if (isset($_SESSION["login"]) && isset($_SESSION["username"])) {
    $loggedInUsername = $_SESSION['username'];
} else {
    $loggedInUsername = '';
}

if (isset($_POST["hapus"])) {
    if (hapusDataSewa() > 0) {
        echo "<script>alert('Hapus Data Berhasil!')
        document.location.href='data_sewa.php'</script>";
    } else {
        echo "<script>alert('Hapus Data Gagal!')
        document.location.href='data_sewa.php'</script>";
    }
}

$id = $_SESSION["user_id"];

$dataSewa = query("SELECT * FROM tb_sewa WHERE id_user = '$id'");



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/data_sewa.css">
    <title>Data Penyewaan</title>
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
            <h1>Data Sewa</h1>
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
                        <th>Status Konfirmasi</th>
                        <th>Aksi</th>
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
                            <td><?= $data["status_bayar"] ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="id_sewa" value="<?= $data["id"] ?>">
                                    <button type="submit" name="hapus" class="btn-hapus">Hapus</button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </section>
    </main>

</body>

</html>