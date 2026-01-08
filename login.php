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
        <form action="" method="post">
            <div>
                <label for="identifiant">Nom d'utilisateur ou email</label>
                <input type="text" name="identifiant" id="identifiant" required>
            </div>
            <div>
                <label for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" required>
            </div>
            <input type="submit" value="Se connecter">
            <button type="submid">Se connecter</button>
        </form>
        <p>Pas encore inscrit ? <a href="index.php?page=register">S'inscrire</a></p>
    </main>
</body>

</html>