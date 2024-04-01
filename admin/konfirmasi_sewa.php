<?php

require '../app/functions.php';

session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true || $_SESSION["level"] !== "admin") {
    // Redirect to login page if not logged in as admin
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION["login"]) && isset($_SESSION["username"])) {
    $loggedInUsername = $_SESSION["username"];
} else {
    $loggedInUsername = "";
}

if (isset($_POST["hapus"])) {
    if (hapusDataSewa() > 0) {
        echo "<script>alert('Hapus Data Berhasil!')
        document.location.href='konfirmasi_sewa.php'</script>";
    } else {
        echo "<script>alert('Hapus Data Gagal!')
        document.location.href='konfirmasi_sewa.php'</script>";
    }
}

if (isset($_POST["konfirmasi"])) {
    if (konfirmasiDataSewa() > 0) {
        echo "<script>document.location.href='konfirmasi_sewa.php'</script>";
    } else {
        echo "<script>alert('Konfirmasi Data Gagal!')
        document.location.href='konfirmasi_sewa.php'</document.location.href=>";
    }
}


$dataSewa = query("SELECT * FROM tb_sewa");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <!-- Styling -->
    <link rel="stylesheet" href="../css/konfirmasi_sewa.css">
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
            <h1>Edit Data Penyewaan</h1>

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
                            <td class="action-form">
                                <?php if ($data["status_bayar"] == "Belum Dikonfirmasi") : ?>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_sewa" value="<?= $data["id"] ?>">
                                        <input type="hidden" name="status_bayar" value="<?= $data["status_bayar"] ?>">
                                        <button type="submit" name="konfirmasi" class="btn-konfirmasi">Konfirmasi</button>
                                    </form>
                                <?php else : ?>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_sewa" value="<?= $data["id"] ?>">
                                        <input type="hidden" name="status_bayar" value="<?= $data["status_bayar"] ?>">
                                        <button type="submit" name="konfirmasi" class="btn-batal-konfirmasi">Batal Konfirmasi</button>
                                    </form>

                                <?php endif; ?>
                                <a href="edit_sewa.php?id_sewa=<?= $data['id'] ?>" class="btn-edit">Edit</a>
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