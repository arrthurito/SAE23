<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Informations de connexion à la base de données
    $host = 'localhost192.168.42.65'; // ou l'adresse IP du serveur MySQL
    $dbname = 'sae23'; // 
    $username = 'root';// bada
    $password = 'sae23sqlroot';

    try {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL pour récupérer l'identifiant et le mot de passe
        $query = "SELECT username, password FROM users WHERE username = :username";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: admin.html"); // Rediriger vers la page sécurisée
            exit();
        } else {
            header("Location: erreur.html"); // Rediriger vers la page d'erreur
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>
