<?php

$connection = mysqli_connect("localhost", "root", "", "db_persewaan_lapangan");

if (!$connection) {
    echo 'Connection Failed';
}

/**
 * Executes a SQL query and returns an array of rows fetched from the database.
 * 
 * @param string $query The SQL Query to be executed.
 * @return array An Array containing rows fetched from the database. 
 */
function query($query)
{
    global $connection;

    $rows = [];
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


/**
 * Validates user credentials and log in the user.  
 * 
 * @param mixed $username, $password
 * @return void
 */
function login($username, $password)
{
    global $connection;

    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $password = md5($password);

    $login = mysqli_query($connection, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);

        if ($data["level"] == "admin") {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $data["id"];
            $_SESSION["level"] = "admin";
            $_SESSION["login"] = true;

            header("Location: ././admin/index.php");
        } else if ($data["level"] == "user") {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $data["id"];
            $_SESSION["level"] = "user";
            $_SESSION["login"] = true;

            header("Location: ././index.php");
        } else {
            header("Location: ././login.php?pesan=gagal");
            exit();
        }

        return false;
    }
}

/**
 * Registers a new user with the provided data. 
 * 
 * @param $data An Associative array containing user data including username and password. 
 * @return int The number of affected rows by the SQL INSERT operation.
 */
function register($data)
{
    global $connection;

    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $password = md5($password);

    mysqli_query($connection, "INSERT INTO tb_user VALUES('', '$username','$password', 'user')");

    return mysqli_affected_rows($connection);
}

/**
 * Processes a booking request and inserts booking data into the database.
 *
 * @param array $data An associative array containing booking data including user details, booking date, time, duration, and other options.
 * @return int The number of affected rows by the SQL INSERT operation.
 */
function pesan($data)
{
    global $connection;

    $id_user = $_SESSION["user_id"];
    $nama_pemesan = htmlspecialchars($data["nama_pemesan"]);
    $no_telepon = htmlspecialchars($data["no_telepon"]);
    $tanggal_pesan = htmlspecialchars($data["tanggal_pesan"]);
    $jam = htmlspecialchars($data["jam_sewa"]);
    $durasi_sewa = htmlspecialchars($data["durasi_sewa"]);
    $kategori_lapangan = htmlspecialchars($data["kategori_lapangan"]);
    $jenis_lapangan = htmlspecialchars($data["jenis_lapangan"]);
    $sewa_sepatu = htmlspecialchars($data["sewa_sepatu"]);
    $sewa_kostum = htmlspecialchars($data["sewa_kostum"]);
    $total_bayar = htmlspecialchars($data["total_bayar"]);

    $query = "SELECT * FROM tb_sewa WHERE tanggal_pesan = '$tanggal_pesan' AND kategori_lapangan = '$kategori_lapangan' AND jenis_lapangan = '$jenis_lapangan'";
    $result = mysqli_query($connection, $query);


    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('The selected date, category, and field type are already booked. Please choose another date or type of field.')
        window.location.href='././sewa_lapangan.php'</script>";
        
        return false; 
    }

    mysqli_query($connection, "INSERT INTO tb_sewa VALUES ('', '$id_user', '$nama_pemesan', '$no_telepon', '$tanggal_pesan', '$jam', '$durasi_sewa', '$kategori_lapangan', '$jenis_lapangan' ,'$sewa_sepatu', '$sewa_kostum', '$total_bayar', 'Belum Dikonfirmasi')");

    return mysqli_affected_rows($connection);
}

function hapusDataSewa()
{
    global $connection;

    $id_sewa = $_POST["id_sewa"];

    mysqli_query($connection, "DELETE FROM tb_sewa WHERE id = '$id_sewa'");

    return mysqli_affected_rows($connection);
}

function editDataSewa($id_sewa, $data)
{
    global $connection;

    $nama_pemesan = htmlspecialchars($data["nama_pemesan"]);
    $no_telepon = htmlspecialchars($data["no_telepon"]);
    $tanggal_pesan = htmlspecialchars($data["tanggal_pesan"]);
    $jam = htmlspecialchars($data["jam_sewa"]);
    $durasi_sewa = htmlspecialchars($data["durasi_sewa"]);
    $kategori_lapangan = htmlspecialchars($data["kategori_lapangan"]);
    $jenis_lapangan = htmlspecialchars($data["jenis_lapangan"]);
    $sewa_sepatu = htmlspecialchars($data["sewa_sepatu"]);
    $sewa_kostum = htmlspecialchars($data["sewa_kostum"]);
    $total_bayar = htmlspecialchars($data["total_bayar"]);


    $sql = "UPDATE tb_sewa SET nama_pemesan = '$nama_pemesan',
                               no_telepon = '$no_telepon',
                               tanggal_pesan = '$tanggal_pesan',
                               jam = '$jam',
                               durasi_sewa = '$durasi_sewa',
                               kategori_lapangan = '$kategori_lapangan',
                               jenis_lapangan = '$jenis_lapangan',
                               sewa_sepatu = '$sewa_sepatu',
                               sewa_kostum = '$sewa_kostum',
                               total_bayar = '$total_bayar'
                               WHERE id = '$id_sewa'";

    mysqli_query($connection, $sql);

    return mysqli_affected_rows($connection);
}

function konfirmasiDataSewa()
{
    global $connection;

    $id_sewa = $_POST["id_sewa"];
    $status_bayar = $_POST["status_bayar"];

    if ($status_bayar == "Belum Dikonfirmasi") {
        mysqli_query($connection, "UPDATE tb_sewa SET status_bayar = 'Telah Dikonfirmasi' WHERE id = '$id_sewa'");
    } else {
        mysqli_query($connection, "UPDATE tb_sewa SET status_bayar = 'Belum Dikonfirmasi' WHERE id = '$id_sewa'");
    }

    return mysqli_affected_rows($connection);
}

function cari($data)
{

    $sql = "SELECT * FROM tb_sewa WHERE nama_pemesan LIKE '%$data%'";

    return query($sql);
}

function cariTanggal($data)
{

    $sql = "SELECT * FROM tb_sewa WHERE tanggal_pesan LIKE '%$data%'";

    return query($sql);
}

