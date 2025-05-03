<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<p>Dostęp zabroniony – brak aktywnej sesji użytkownika.</p>";
    echo "<p>Zaloguj się najpierw, aby uzyskać dostęp do formularza rezerwacji.</p>";
    echo "<a href='login.php'>Zaloguj się</a>";
    exit();
}

// obsługa przycisku czyszczenia ciasteczek
if (isset($_GET['clear']) && $_GET['clear'] === '1') {
    foreach ($_COOKIE as $key => $val) {
        setcookie($key, "", time() - 3600, "/");
    }
    header("Location: Dane.php");
    exit();
}

// zapamiętywanie danych po przesłaniu
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($_POST as $key => $value) {
        setcookie($key, $value, time() + 86400, "/"); // 1 dzień
    }
    header("Location: Rezerwacje.php");
    exit();
}

$quantity = isset($_COOKIE['quantity']) ? $_COOKIE['quantity'] : 1;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz Rezerwacji Hotelu</title>
</head>
<body>
<h2>Witaj, <?php echo isset($_COOKIE['user']) ? htmlspecialchars($_COOKIE['user']) : "użytkowniku"; ?>!</h2>
<a href="logout.php">Wyloguj się</a> |
<a href="Dane.php?clear=1">Wyczyść formularz</a>

<form action="Dane.php" method="post">
    <label for="quantity">Liczba osób:</label>
    <select name="quantity" id="quantity">
        <?php
        for ($i = 1; $i <= 4; $i++) {
            $selected = ($i == $quantity) ? "selected" : "";
            echo "<option value='$i' $selected>$i osoba</option>";
        }
        ?>
    </select><br><br>

    <?php
    for ($i = 0; $i < $quantity; $i++) {
        $name = isset($_COOKIE["name$i"]) ? $_COOKIE["name$i"] : "";
        $surname = isset($_COOKIE["surname$i"]) ? $_COOKIE["surname$i"] : "";
        echo "<fieldset>";
        echo "<legend>Osoba " . ($i + 1) . "</legend>";
        echo "<label>Imię: <input type='text' name='name$i' value='$name' required></label><br><br>";
        echo "<label>Nazwisko: <input type='text' name='surname$i' value='$surname' required></label><br><br>";
        echo "</fieldset>";
    }
    ?>

    <fieldset>
        <legend>Dodatkowe informacje</legend>
        <label>Adres: <input type="text" name="address" value="<?php echo $_COOKIE['address'] ?? '' ?>" required></label><br><br>
        <label>Numer karty: <input type="text" name="credit_card" value="<?php echo $_COOKIE['credit_card'] ?? '' ?>" required></label><br><br>
        <label>Email: <input type="email" name="email" value="<?php echo $_COOKIE['email'] ?? '' ?>" required></label><br><br>
        <label>Data pobytu: <input type="date" name="stay_date" value="<?php echo $_COOKIE['stay_date'] ?? '' ?>" required></label><br><br>
        <label>Godzina przyjazdu: <input type="time" name="arrival_time" value="<?php echo $_COOKIE['arrival_time'] ?? '' ?>" required></label><br><br>
        <label>Dostawienie łóżka: <input type="checkbox" name="child_bed" <?php echo isset($_COOKIE['child_bed']) ? "checked" : "" ?>></label><br><br>
        <label>Udogodnienia:
            <select name="amenities[]" multiple>
                <option value="klimatyzacja" <?php echo (isset($_COOKIE['amenities']) && in_array("klimatyzacja", (array)$_COOKIE['amenities'])) ? "selected" : "" ?>>Klimatyzacja</option>
                <option value="popielniczka" <?php echo (isset($_COOKIE['amenities']) && in_array("popielniczka", (array)$_COOKIE['amenities'])) ? "selected" : "" ?>>Popielniczka</option>
            </select>
        </label><br><br>
    </fieldset>

    <input type="submit" value="Zarezerwuj">
</form>
</body>
</html>