<?php
session_start();

// Jeśli już zalogowany, przekieruj
if (isset($_SESSION['login'])) {
    header("Location: Rezerwacje.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>
<h2>Logowanie</h2>
<form action="chceck_login.php" method="post">
    <label>Login: <input type="text" name="login" required></label><br><br>
    <label>Hasło: <input type="password" name="haslo" required></label><br><br>
    <input type="submit" value="Zaloguj">
</form>
</body>
</html>