<?php
if (!is_logged_in()) {
    redirect('index.php');
}

$errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-btn'])) {
    $username = nettoyer($_POST['username']) ?? '';
    $email = nettoyer($_POST['email']) ?? '';

    $resultat = update_user($pdo, $username, $email, );

    if ($resultat['success']) {
        redirect('home.php');
    } else {
        $errors = $resultat['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <main>
        <h1>Profil utilisateur</h1>
        <?php if ($errors): ?>
            <div class="alert"><?= $errors ?></div>
        <?php endif ?>
        <form method="post">
            <div>
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" value="<?= $_SESSION['username'] ?>" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= $_SESSION['email'] ?>" required>
            </div>
            <input type="submit" name="update-btn" value="Mettre à jour">
        </form>
    </main>
</body>

</html>