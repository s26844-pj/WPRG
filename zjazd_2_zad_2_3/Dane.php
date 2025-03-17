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
        $quantity = $_POST['quantity'];
        for ($i = 0; $i < $quantity; $i++) {
            echo "<fieldset>";
            echo "<legend>Osoba " . ($i + 1) . "</legend>";
            echo '<label for="name' . $i . '">Imię:</label>';
            echo '<input type="text" id="name' . $i . '" name="name' . $i . '" required><br><br>';
            echo '<label for="surname' . $i . '">Nazwisko:</label>';
            echo '<input type="text" id="surname' . $i . '" name="surname' . $i . '" required><br><br>';
            echo "</fieldset>";
        }
    ?>
    <fieldset>
        <legend>Dodatkowe informacje</legend>
        <label for="address">Adres:</label>
        <input type="text" id="address" name="address" required><br><br>
        <label for="credit_card">Numer karty kredytowej:</label>
        <input type="text" id="credit_card" name="credit_card" required><br><br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="stay_date">Data pobytu:</label>
        <input type="date" id="stay_date" name="stay_date" required><br><br>
        <label for="arrival_time">Godzina przyjazdu:</label>
        <input type="time" id="arrival_time" name="arrival_time" required><br><br>
        <label for="child_bed">Dostawienie łóżka dla dziecka:</label>
        <input type="checkbox" id="child_bed" name="child_bed"><br><br>
        <label for="amenities">Udogodnienia:</label>
        <select id="amenities" name="amenities[]" multiple required>
            <option value="klimatyzacja">Klimatyzacja</option>
            <option value="popielniczka">Popielniczka dla palacza</option>
            <!-- Dodaj więcej opcji według potrzeb -->
        </select><br><br>
    </fieldset>
    <input type="submit" value="Zarezerwuj">
</form>
</body>
</html>
