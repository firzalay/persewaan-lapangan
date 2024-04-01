<?php

require 'app/functions.php';

session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
}

if (isset($_POST["register"])) {

    if (register($_POST) > 0) {
        echo "<script>alert('Registrasi Berhasil!')
                      document.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Registrasi Gagal!')
        document.location.href='register.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register Page</title>
    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="css/logreg.css">
</head>

<body>
    <main>
        <section>
            <h2>Daftar</h2>
            <form action="" method="POST">

                <input type="text" name="username" placeholder="Username..." required>

                <input type="password" name="password" placeholder="Password..." required>

                <button type="submit" name="register">Daftar</button>
            </form>
            <p>SUdah punya akun? <a href="login.php">Login sekarang!</a></p>
        </section>
    </main>
</body>

</html>