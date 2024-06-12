<?php
// Configuration de la base de données
$servername = "localhost";
$username = "sae23";
$password = "sae23";
$dbname = "sae23";

try {
    // Créer une connexion
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie"; 
}
catch(PDOException $e) {
    echo "La connexion a échoué: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>