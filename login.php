<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = file("users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $isAuthenticated = false;

    foreach ($users as $user) {
        list($stored_username, $stored_hashed_password) = explode(",", $user);
        if ($username == $stored_username && password_verify($password, $stored_hashed_password)) {
            $isAuthenticated = true;
            $_SESSION['username'] = $username;
            break;
        }
    }

    if ($isAuthenticated) {
        // Redirection vers une page sécurisée
        header("Location: admin.html");
        exit();
    } else {
        // Redirection vers la page d'erreur ou de connexion avec un message d'erreur
        header("Location: erreur.html");
        exit();
    }
}
?>
