<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zadanie_1</title>
</head>
<body>
<form action="" method="post">
    <input type="number" name="x" placeholder="Podaj pierwsza wartosc" max="99" value="<?= isset($_POST['x']) ? $_POST['x'] : '' ?>">
    <input type="number" name="y" placeholder="Podaj druga wartosc" max="99" value="<?= isset($_POST['y']) ? $_POST['y'] : '' ?>">
    <select name="wybor">
        <option value="dodaj" <?= (isset($_POST['wybor']) && $_POST['wybor'] == 'dodaj') ? 'selected' : '' ?>>Dodawanie</option>
        <option value="odejmij" <?= (isset($_POST['wybor']) && $_POST['wybor'] == 'odejmij') ? 'selected' : '' ?>>Odejmowanie</option>
        <option value="pomnoz" <?= (isset($_POST['wybor']) && $_POST['wybor'] == 'pomnoz') ? 'selected' : '' ?>>Mnożenie</option>
        <option value="podziel" <?= (isset($_POST['wybor']) && $_POST['wybor'] == 'podziel') ? 'selected' : '' ?>>Dzielenie</option>
    </select>
    <button type="submit">Oblicz</button>
</form>

<?php
require 'dzialania.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $x = $_POST['x'];
    $y = $_POST['y'];
    $wybor = $_POST['wybor'];

    if (isset($x, $y) && is_numeric($x) && is_numeric($y)) {
        switch ($wybor) {
            case "dodaj":
                echo "Wynik: " . dodaj($x, $y);
                break;
            case "odejmij":
                echo "Wynik: " . odejmij($x, $y);
                break;
            case "pomnoz":
                echo "Wynik: " . pomnoz($x, $y);
                break;
            case "podziel":
                echo "Wynik: " . podziel($x, $y);
                break;
            default:
                echo "Niepoprawny operator";
        }
    } else {
        echo "Wpisz obie liczby!";
    }
}
?>
</body>
</html>
