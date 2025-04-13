<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie Rezerwacji</title>
</head>
<body>
<h2>Podsumowanie Rezerwacji</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    echo "<p><strong>Liczba osób:</strong> $quantity</p>";

    for ($i = 0; $i < $quantity; $i++) {
        $name = isset($_POST["name$i"]) ? $_POST["name$i"] : '';
        $surname = isset($_POST["surname$i"]) ? $_POST["surname$i"] : '';
        echo "<p><strong>Osoba ".($i+1).":</strong> $name $surname</p>";
    }

    // Tu możesz też dodać wyświetlanie innych pól np. adresu, maila, itd.
} else {
    echo "<p>Nieprawidłowe zapytanie HTTP.</p>";
}
?>
</body>
</html>
