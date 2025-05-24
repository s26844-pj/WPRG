<?php
include 'db.php';
$id = (int) ($_GET['id'] ?? 0);
$result = mysqli_query($conn, "SELECT * FROM samochody WHERE id = $id");
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head><title>Szczegóły samochodu</title></head>
<body>
    <a href="index.php">Powrót</a>
    <h1>Szczegóły samochodu</h1>
    <p>ID: <?php echo $row['id']; ?></p>
    <p>Marka: <?php echo $row['marka']; ?></p>
    <p>Model: <?php echo $row['model']; ?></p>
    <p>Cena: <?php echo $row['cena']; ?></p>
    <p>Rok: <?php echo $row['rok']; ?></p>
    <p>Opis: <?php echo $row['opis']; ?></p>
</body>
</html>
