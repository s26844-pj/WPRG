<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Podsumowanie Rezerwacji</title>
</head>
<body>
<h2>Podsumowanie Rezerwacji</h2>

<?php
$plik_csv = "rezerwacje.csv";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit_rezerwacja'])) {
        // Pobranie danych
        $quantity = $_POST['quantity'];
        $adres = $_POST['address'];
        $karta = $_POST['credit_card'];
        $email = $_POST['email'];
        $data_pobytu = $_POST['stay_date'];
        $godzina = $_POST['arrival_time'];
        $lozko = isset($_POST['child_bed']) ? 'tak' : 'nie';
        $udogodnienia = isset($_POST['amenities']) ? implode(",", $_POST['amenities']) : "";

        // Przygotowanie danych jednej rezerwacji
        $rekord = [];
        for ($i = 0; $i < $quantity; $i++) {
            $rekord[] = $_POST["name$i"];
            $rekord[] = $_POST["surname$i"];
        }
        $rekord[] = $adres;
        $rekord[] = $karta;
        $rekord[] = $email;
        $rekord[] = $data_pobytu;
        $rekord[] = $godzina;
        $rekord[] = $lozko;
        $rekord[] = $udogodnienia;

        // Nagłówki CSV – tylko przy pierwszym zapisie
        if (!file_exists($plik_csv)) {
            $naglowki = [];
            for ($i = 0; $i < $quantity; $i++) {
                $naglowki[] = "Imie_$i";
                $naglowki[] = "Nazwisko_$i";
            }
            $naglowki = array_merge($naglowki, ["Adres", "Karta", "Email", "Data_pobytu", "Godzina", "Lozko_dziecko", "Udogodnienia"]);
            $fp = fopen($plik_csv, "a");
            fputcsv($fp, $naglowki, ";");
            fclose($fp);
        }

        // Zapis danych
        $fp = fopen($plik_csv, "a");
        fputcsv($fp, $rekord, ";");
        fclose($fp);

        echo "<p><strong>Dane zostały zapisane do pliku CSV.</strong></p>";
    }

    if (isset($_POST['submit_wczytaj'])) {
        echo "<h3>Wczytane dane z pliku CSV:</h3>";
        if (file_exists($plik_csv)) {
            echo "<table border='1' cellpadding='5'>";
            if (($fp = fopen($plik_csv, "r")) !== false) {
                while (($data = fgetcsv($fp, 1000, ";")) !== false) {
                    echo "<tr>";
                    foreach ($data as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                }
                fclose($fp);
            }
            echo "</table>";
        } else {
            echo "<p>Brak zapisanych rezerwacji.</p>";
        }
    }
}
?>

<br>
<form method="post">
    <input type="submit" name="submit_wczytaj" value="Wczytaj dane z pliku CSV">
</form>
</body>
</html>
