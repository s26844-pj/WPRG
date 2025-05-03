<?php
session_start();

$valid_login = "admin";
$valid_password = "1234";

$login = $_POST['login'] ?? '';
$password = $_POST['haslo'] ?? '';

if ($login === $valid_login && $password === $valid_password) {
    $_SESSION['login'] = $login;
    setcookie("login", $login, time() + 3600, "/");
    header("Location: Rezerwacje.php");
    exit();
} else {
    echo "Błędny login lub hasło. <a href='login.php'>Spróbuj ponownie</a>";
}
