<?php

require '../app/functions.php';


// Session
session_start();

if (isset($_SESSION["login"]) && isset($_SESSION["username"])) {
    $loggedInUsername = $_SESSION["username"];
} else {
    $loggedInUsername = '';
}

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

$id_sewa = $_GET["id_sewa"];

if (isset($_POST["pesan"])) {
    if (editDataSewa($id_sewa, $_POST) > 0) {
        echo "<script>alert('Edit Lapangan Berhasil!')
        document.location.href='konfirmasi_sewa.php'</script>";
    } else {
        echo "<script>alert('Edit Lapangan Gagal!')
        document.location.href='konfirmasi_sewa.php'</script>";
    }
}

$dataSewa = query("SELECT * FROM tb_sewa WHERE id = '$id_sewa'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit_sewa.css">

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
            <h1>Sewa Lapangan</h1>
            <form action="" method="POST">
                <?php foreach ($dataSewa as $data) : ?>
                    <div class="row-1">
                        <input type="text" id="nama_pemesan" name="nama_pemesan" placeholder="Nama Pemesan" value="<?= $data["nama_pemesan"] ?>" required>
                        <input type="text" id="no_telepon" name="no_telepon" placeholder="No Telepon" value="<?= $data["no_telepon"] ?>">
                    </div>
                    <div class="row-2">
                        <div class="col-1">
                            <label for="tanggal_pesan">Tanggal Pemesanan</label>
                            <input type="date" id="tanggal_pesan" name="tanggal_pesan" value="<?= $data["tanggal_pesan"] ?>" required>
                        </div>

                        <div class="col-2">
                            <label for="jam_sewa">Jam Sewa</label>
                            <input type="time" id="jam_sewa" name="jam_sewa" value="<?= $data["jam"] ?>" required>
                        </div>

                        <div class="col-3">
                            <label for="durasi_sewa">Durasi Sewa Per Jam</label>
                            <input type="number" id="durasi_sewa" name="durasi_sewa" min="1" value="<?= $data["durasi_sewa"] ?>" required>
                        </div>
                    </div>
                    <div class="row-3">
                        <label for="kategori_lapangan">Kategori Lapangan</label>
                        <select name="kategori_lapangan" id="kategori_lapangan" required>
                            <option value="Indoor" <?php if ($data["kategori_lapangan"] == "Indoor") : ?> echo selected='selected' <?php endif; ?>>Indoor</option>
                            <option value="Outdoor" <?php if ($data["kategori_lapangan"] == "Outdoor") : ?> echo selected='selected' <?php endif; ?>>Outdoor</option>
                        </select>
                    </div>
                    <div class="row-4">
                        <label for="jenis_lapangan">Jenis Lapangan</label>
                        <select name="jenis_lapangan" id="jenis_lapangan" required>
                            <option value="Reguler" <?php if ($data["jenis_lapangan"] == "Reguler") : ?> echo selected='selected' <?php endif; ?>>Reguler</option>
                            <option value="Matras" <?php if ($data["jenis_lapangan"] == "Matras") : ?> echo selected='selected' <?php endif; ?>>Matras</option>
                            <option value="Rumput" <?php if ($data["jenis_lapangan"] == "Rumput") : ?> echo selected='selected' <?php endif; ?>>Rumput</option>
                        </select>
                    </div>
                    <div class="row-5">
                        <div class="col-1">
                            <label for="sewa_kostum">Sewa Kostum (Optional)</label>
                            <input type="number" id="sewa_kostum" name="sewa_kostum" min="1" placeholder="Jumlah Per Orang" value="<?= $data["sewa_kostum"] ?>">
                        </div>
                        <div class="col-2">
                            <label for="sewa_sepatu">Sewa Sepatu (Optional)</label>
                            <input type="number" id="sewa_sepatu" name="sewa_sepatu" min="1" placeholder="Jumlah Per Orang" value="<?= $data["sewa_sepatu"] ?>">
                        </div>
                    </div>
                    <div class="row-6">
                        <div class="col-1">
                            <label for="bayar">Bayar</label>
                            <input type="text" id="bayar" name="bayar">
                        </div>
                        <div class="col-2">
                            <label for="total_bayar">Total Harga</label>
                            <input type="text" id="total_bayar" name="total_bayar" value="<?= $data["total_bayar"] ?>" readonly>
                        </div>
                    </div>
                    <div class="row-7">
                        <label for="uang_kembali">Uang Kembali</label>
                        <input type="text" id="uang_kembali" name="uang_kembali" readonly>
                    </div>
                    <button type="submit" name="pesan">Edit</button>
                <?php endforeach; ?>
            </form>
        </section>
    </main>

    <script src="../js/priceCalculation.js"></script>
</body>

</html>