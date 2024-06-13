<?php
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le login et le mot de passe depuis le formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Informations de connexion à la base de données
    $servername = "localhost";
    $dbusername = "sae23";
    $dbpassword = "sae23";
    $dbname = "sae23";

    // Créer une connexion
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Préparer la requête SQL pour vérifier l'authentification
    $sql = "SELECT * FROM Administration WHERE login = '$username' AND mdp = '$password'";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Erreur dans la requête: " . $conn->error);
    }

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($result->num_rows > 0) {
        // Authentification réussie, démarrer la session
        $_SESSION['username'] = $username;
        $_SESSION['auth'] = true;
        header("Location: admin.html"); // Rediriger vers la page sécurisée
        exit();
    } else {
        // Authentification échouée, rediriger vers la page d'erreur de connexion
        $_SESSION = array(); // Réinitialisation du tableau de session
        session_destroy();   // Destruction de la session
        header("Location: erreur.html"); // Rediriger vers la page d'erreur de connexion
        exit();
    }

    // Fermer la connexion
    $conn->close();
}
?>
