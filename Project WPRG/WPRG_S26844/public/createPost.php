<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;

// Wymagane logowanie
if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php?needLogin=1');
    exit;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '' || $content === '') {
        $errors[] = 'Podaj tytuł i treść.';
    }

    // Obraz (opcjonalny)
    $imageName = 'default.jpg';
    if (!$errors && isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $safeName = preg_replace('~[^a-zA-Z0-9._-]+~', '_', $_FILES['image']['name']);
        $destDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage';
        if (!is_dir($destDir)) {
            @mkdir($destDir, 0777, true);
        }
        $destPath = $destDir . DIRECTORY_SEPARATOR . $safeName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destPath)) {
            $imageName = $safeName;
        } else {
            $errors[] = 'Nie udało się zapisać pliku do /storage. Sprawdź uprawnienia i ścieżkę.';
        }
    }

    if (!$errors) {
        $db = (new Database())->getConnection(); // mysqli
        $userId = (int)$_SESSION['user']['id'];

        $stmt = $db->prepare("INSERT INTO wprg_posts (title, content, image, wprg_users_id) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            $errors[] = "Błąd bazy (prepare): " . $db->error;
        } else {
            $stmt->bind_param("sssi", $title, $content, $imageName, $userId);
            if ($stmt->execute()) {
                header('Location: index.php?created=1');
                exit;
            } else {
                $errors[] = "Błąd bazy (execute): " . $db->error;
            }
        }
    }
}
?>
<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nowy wpis</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/theme.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">Wyprawnik</a>
  </div>
</nav>

<header class="hero">
  <div class="container">
    <h1>Dodaj nowy wpis</h1>
    <p class="small-muted mb-0">Uzupełnij tytuł, treść i opcjonalny obraz.</p>
  </div>
</header>

<div class="container" style="max-width:700px">
  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $e): ?>
        <div><?= htmlspecialchars($e) ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="card p-4">
    <form method="POST" action="createPost.php" enctype="multipart/form-data" novalidate>
      <div class="form-group mb-3">
        <label for="title">Tytuł</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="form-group mb-3">
        <label for="content">Treść</label>
        <textarea class="form-control" id="content" name="content" rows="8" required></textarea>
      </div>
      <div class="form-group mb-4">
        <label for="image">Obraz (opcjonalnie)</label>
        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        <small class="form-text text-muted">Jeśli nie wybierzesz pliku – użyjemy default.jpg</small>
      </div>
      <button type="submit" class="btn btn-primary">Zapisz wpis</button>
      <a href="index.php" class="btn btn-outline-primary ms-2">Anuluj</a>
    </form>
  </div>
</div>

<footer class="footer">
  <div class="container small-muted">© 2025 Wyprawnik • Wszystkie prawa zastrzeżone</div>
</footer>

<script src="./js/bootstrap.bundle.min.js"></script>
<script src="assets/js/theme.js"></script>
</body>
</html>
