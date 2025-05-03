<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "Brak dostępu. Musisz być zalogowany, aby zarezerwować hotel.";
    echo "<br>Powód: Nie masz aktywnej sesji użytkownika.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rezerwacja hotelu</title>
</head>
<body>

<h2>Formularz rezerwacji</h2>

<?php
if (isset($_COOKIE["login"])) {
    echo "<p>Witaj, " . htmlspecialchars($_COOKIE["login"]) . "!</p>";
}
?>

<form method="post">
    <label>Imię: <input type="text" name="imie" value="<?php if(isset($_COOKIE['imie'])) echo $_COOKIE['imie']; ?>"></label><br>
    <label>Nazwisko: <input type="text" name="nazwisko" value="<?php if(isset($_COOKIE['nazwisko'])) echo $_COOKIE['nazwisko']; ?>"></label><br>
    <label>Data przyjazdu: <input type="date" name="data" value="<?php if(isset($_COOKIE['data'])) echo $_COOKIE['data']; ?>"></label><br><br>
    
    <button type="submit" name="zapisz">Zapisz dane</button>
    <button type="submit" name="usun">Wyczyść dane</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["zapisz"])) {
        setcookie("imie", $_POST["imie"], time()+3600, "/");
        setcookie("nazwisko", $_POST["nazwisko"], time()+3600, "/");
        setcookie("data", $_POST["data"], time()+3600, "/");
        echo "<p>Dane zostały zapisane.</p>";
    }

    if (isset($_POST["usun"])) {
        setcookie("imie", "", time()-3600, "/");
        setcookie("nazwisko", "", time()-3600, "/");
        setcookie("data", "", time()-3600, "/");
        echo "<p>Dane zostały usunięte.</p>";
    }
}
?>

<p><a href="logout.php">Wyloguj się</a></p>

</body>
</html>
