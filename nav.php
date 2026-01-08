<ul>
    <?php if (is_logged_in()) : ?>
    (<?= $_SESSION['username']; ?>)
    <li><a href="index.php?page=admin">Dashboard blog</a></li>
    <li><a href="index.php?page=profil">Profil</a></li>
    <li><a href="index.php?page=logout">Déconnexion</a></li>
    <?php else : ?>
    <li><a href="index.php?page=login">Se connecter</a></li>
    <?php endif; ?>
</ul>