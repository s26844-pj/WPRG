<!DOCTYPE html>
<html>
<head><title>Dodaj samochód</title></head>
<body>
    <a href="index.php">Powrót</a>
    <h1>Dodaj samochód</h1>
    <form action="insert.php" method="post">
        Marka: <input type="text" name="marka"><br>
        Model: <input type="text" name="model"><br>
        Cena: <input type="number" name="cena"><br>
        Rok: <input type="number" name="rok"><br>
        Opis: <textarea name="opis"></textarea><br>
        <input type="submit" value="Dodaj">
    </form>
</body>
</html>
