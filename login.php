<?php
if (is_logged_in()) {
    redirect('index.php');
}

$errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion-btn'])) {
    $identifiant = $_POST['identifiant'] ?? '';
    $password = $_POST['password'] ?? '';

    $resultat = login_user($pdo, $identifiant, $password);

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
    <title>Connexion</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <main>
        <h1>Connexion</h1>
        <?php if ($errors): ?>
            <div class="alert"><?= $errors ?></div>
        <?php endif ?>
        <form method="post">
            <div>
                <label for="identifiant">Nom d'utilisateur ou email</label>
                <input type="text" name="identifiant" id="identifiant" required>
            </div>
            <div>
                <label for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" required>
            </div>
            <input type="submit" name="connexion-btn" value="Se connecter">
        </form>
        <p>Pas encore inscrit ? <a href="index.php?page=register">S'inscrire</a></p>
    </main>
</body>

</html>