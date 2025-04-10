<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz Rezerwacji Hotelu</title>
</head>
<body>
<h2>Uzupełnij dane</h2>

<form action="Rezerwacje.php" method="post">
    <?php
    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];

        // Formularz dla każdej osoby
        for ($i = 0; $i < $quantity; $i++) {
            echo "<fieldset>";
            echo "<legend>Osoba " . ($i + 1) . "</legend>";
            echo '<label for="name' . $i . '">Imię:</label>';
            echo '<input type="text" id="name' . $i . '" name="name' . $i . '" required><br><br>';
            echo '<label for="surname' . $i . '">Nazwisko:</label>';
            echo '<input type="text" id="surname' . $i . '" name="surname' . $i . '" required><br><br>';
            echo "</fieldset>";
        }

        // Dodatkowe dane rezerwacji
        echo '<fieldset>';
        echo '<legend>Dodatkowe informacje</legend>';
        echo '<label for="address">Adres:</label>';
        echo '<input type="text" id="address" name="address" required><br><br>';

        echo '<label for="credit_card">Numer karty kredytowej:</label>';
        echo '<input type="text" id="credit_card" name="credit_card" required><br><br>';

        echo '<label for="email">E-mail:</label>';
        echo '<input type="email" id="email" name="email" required><br><br>';

        echo '<label for="stay_date">Data pobytu:</label>';
        echo '<input type="date" id="stay_date" name="stay_date" required><br><br>';

        echo '<label for="arrival_time">Godzina przyjazdu:</label>';
        echo '<input type="time" id="arrival_time" name="arrival_time" required><br><br>';

        echo '<label for="child_bed">Dostawienie łóżka dla dziecka:</label>';
        echo '<input type="checkbox" id="child_bed" name="child_bed"><br><br>';

        echo '<label for="amenities">Udogodnienia:</label>';
        echo '<select id="amenities" name="amenities[]" multiple required>';
        echo '<option value="klimatyzacja">Klimatyzacja</option>';
        echo '<option value="popielniczka">Popielniczka dla palacza</option>';
        echo '</select><br><br>';
        echo '</fieldset>';

        // Ukryte pole do przekazania liczby osób
        echo '<input type="hidden" name="quantity" value="' . $quantity . '">';

        // Przycisk zapisu
        echo '<input type="submit" name="submit_rezerwacja" value="Zarezerwuj">';
    } else {
        echo "<p>Nie podano liczby osób. Wróć do formularza początkowego.</p>";
    }
    ?>
</form>
</body>
</html>
