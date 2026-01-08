<?php
if (is_logged_in()) {
    redirect('index.php');
}

$errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription-btn'])) {
    $username = nettoyer($_POST['username']) ?? '';
    $email = nettoyer($_POST['email']) ?? '';
    $password = trim($_POST['password']) ?? '';
    $password_confirm = trim($_POST['password_confirm']) ?? '';

    if ($password !== $password_confirm) {
        $errors = 'Les mots de passe ne correspondent pas';
    } else {
        $resultat = register_user($pdo, $username, $email, $password);

        if ($resultat['success']) {
            redirect('login.php');
        } else {
            $errors = $resultat['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <main>
        <h1>Inscription</h1>
        <?php if ($errors): ?>
            <div class="alert"><?= $errors ?></div>
        <?php endif ?>
        <form method="post">
            <div>
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" required>
                <small>Le mot de passe doit contenir au moins 6 caractères.</small>
            </div>
            <div>
                <label for="password_confirm">Confirmation mot de passe : </label>
                <input type="password_confirm" name="password_confirm" id="password_confirm" required>
            </div>
            <input type="submit" name="inscription-btn" value="S'inscrire">
        </form>
    </main>
</body>

</html>