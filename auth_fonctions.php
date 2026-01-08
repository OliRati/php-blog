<?php
require 'config.php';
require 'condb.php';

function is_logged_in()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function logout_user()
{
    $_SESSION = [];
    session_destroy();
    session_unset();
}

function login_user($pdo, $identifiant, $password)
{
    if (empty($identifiant) || empty($password)) {
        return [
            'success' => false,
            'message' => 'Tous les champs sont obligatoires.'
        ];
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$identifiant, $password]);
    $user = $stmt->fetch();

    if (!$user) {
        return [
            'success' => false,
            'message' => 'Identifiant incorrect !'
        ];
    }

    // if (md5($password) !== $user['password']) {
    if (!password_verify($password, $user['password'])) {
        return [
            'success' => false,
            'message' => 'Identifiant incorrect !'
        ];
    }

    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];

    return [
        'success' => true,
        'message' => 'Connexion réussie.'
    ];
}

function register_user($pdo, $username, $email, $password)
{
    if (empty($username) || empty($email) || empty($password)) {
        return [
            'success' => false,
            'message' => 'Tous les champs sont obligatoires.'
        ];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'success' => false,
            'message' => 'Email invalide.'
        ];
    }

    if (strlen($password) < 6) {
        return [
            'success' => false,
            'message' => 'Le mot de passe doit contenir au moins 6 caractères.'
        ];
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);

    if ($stmt->fetch()) {
        return [
            'success' => false,
            'message' => 'Nom d\'utilisateur ou email déja utilisé.'
        ];
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO blog.users (username, email, password, created_at) VALUES (?,?,?, NOW())");
    if ($stmt->execute([$username, $email, $password_hashed])) {
        return [
            'success' => true,
            'message' => 'Inscription réussie.'
        ];
    }

    return [
        'success' => false,
        'message' => 'Erreur lors de l\'inscription.'
    ];
}

function update_user($pdo, $username, $email)
{
    if (empty($username) || empty($email)) {
        return [
            'success' => false,
            'message' => 'Tous les champs sont obligatoires.'
        ];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'success' => false,
            'message' => 'Email invalide.'
        ];
    }

    $stmt = $pdo->prepare("UPDATE users SET username=?, email=? WHERE id = ?");
    if ($stmt->execute([$username, $email, $_SESSION['user_id']])) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        return [
            'success' => true,
            'message' => 'Mise à jour effectuée'
        ];
    }

    return [
        'success' => false,
        'message' => 'Erreur lors de la mise à jour'
    ];
}