<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Database;

// Obsługa formularza
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = 'Podaj login i hasło.';
    } elseif (mb_strlen($password) < 6) {
        $errors[] = 'Hasło musi mieć co najmniej 6 znaków.';
    }

    if (!$errors) {
        $db = (new Database())->getConnection(); // mysqli
        // Sprawdź czy user istnieje
        $stmt = $db->prepare("SELECT id FROM wprg_users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'Użytkownik o takiej nazwie już istnieje.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $db->prepare("INSERT INTO wprg_users (username, `password`, role) VALUES (?, ?, 'USER')");
            $ins->bind_param("ss", $username, $hash);
            if ($ins->execute()) {
                header('Location: login.php?registered=1');
                exit;
            } else {
                $errors[] = 'Błąd bazy podczas rejestracji.';
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
  <title>Rejestracja</title>
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
    <h1>Załóż konto</h1>
    <p class="small-muted mb-0">Dołącz i dodawaj komentarze oraz wpisy.</p>
  </div>
</header>

<div class="container" style="max-width:520px">
  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $e): ?>
        <div><?= htmlspecialchars($e) ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="card p-4">
    <form method="POST" action="register.php" novalidate>
      <div class="form-group mb-3">
        <label for="username">Login</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group mb-4">
        <label for="password">Hasło (min. 6 znaków)</label>
        <input type="password" class="form-control" id="password" name="password" minlength="6" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Zarejestruj</button>
    </form>
    <p class="mt-3 small-muted mb-0">Masz konto? <a href="login.php">Zaloguj się</a>.</p>
  </div>
</div>

<footer class="footer">
  <div class="container small-muted">© 2025 Wyprawnik • Wszystkie prawa zastrzeżone</div>
</footer>

<script src="./js/bootstrap.bundle.min.js"></script>
<script src="assets/js/theme.js"></script>
</body>
</html>
