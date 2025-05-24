<?php global $conn;
include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Wszystkie samochody</title></head>
<body>
    <a href="index.php">Powrót</a>
    <h1>Wszystkie samochody</h1>
    <table border="1">
        <tr><th>ID</th><th>Marka</th><th>Model</th><th>Cena</th></tr>
        <?php
        $result = mysqli_query($conn, "SELECT id, marka, model, cena FROM samochody ORDER BY rok DESC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td><a href='details.php?id={$row['id']}'>{$row['id']}</a></td><td>{$row['marka']}</td><td>{$row['model']}</td><td>{$row['cena']}</td></tr>";
        }
        ?>
    </table>
</body>
</html>
