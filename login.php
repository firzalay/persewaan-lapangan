<?php

require 'app/functions.php';

session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $login_result = login($username, $password);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="css/logreg.css">
</head>

<body>
    <main>
        <section>
            <h2>Login</h2>
            <form action="" method="POST">

                <input type="text" name="username" placeholder="Username..." required>

                <input type="password" name="password" placeholder="Password..." required>

                <button type="submit" name="login">Masuk</button>
            </form>
            <p>Belum punya akun? <a href="register.php">Daftar Segera!</a></p>
        </section>
    </main>
</body>

</html>