<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marka = mysqli_real_escape_string($conn, $_POST['marka'] ?? '');
    $model = mysqli_real_escape_string($conn, $_POST['model'] ?? '');
    $cena = (float) ($_POST['cena'] ?? 0);
    $rok = (int) ($_POST['rok'] ?? 0);
    $opis = mysqli_real_escape_string($conn, $_POST['opis'] ?? '');

    $query = "INSERT INTO samochody (marka, model, cena, rok, opis) VALUES ('$marka', '$model', $cena, $rok, '$opis')";
    if (mysqli_query($conn, $query)) {
        echo "Samochód dodany! <a href='index.php'>Powrót</a>";
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
}
?>
