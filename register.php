<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Créer une chaîne au format "nom_utilisateur,mot_de_passe" à écrire dans le fichier
    $userData = $username . "," . $password . "\n";

    // Écrire les données dans le fichier "users.txt"
    file_put_contents("users.txt", $userData, FILE_APPEND | LOCK_EX);

    // Redirection vers une page de confirmation ou autre
    header("Location: confirmation.html");
    exit();
}
?>
