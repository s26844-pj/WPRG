<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Portal Samochodowy</title></head>
<body>
    <table>
        <tr>
            <td><a href="index.php">Strona główna</a></td>
            <td><a href="cars.php">Wszystkie samochody</a></td>
            <td><a href="add.php">Dodaj samochód</a></td>
        </tr>
    </table>
    <h1>5 najtańszych samochodów</h1>
    <table border="1">
        <tr><th>ID</th><th>Marka</th><th>Model</th><th>Cena</th></tr>
        <?php
        $result = mysqli_query($conn, "SELECT id, marka, model, cena FROM samochody ORDER BY cena ASC LIMIT 5");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td><a href='details.php?id={$row['id']}'>{$row['id']}</a></td><td>{$row['marka']}</td><td>{$row['model']}</td><td>{$row['cena']}</td></tr>";
        }
        ?>
    </table>
</body>
</html>
