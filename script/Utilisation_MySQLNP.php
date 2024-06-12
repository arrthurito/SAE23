<?php
// Configuration de la base de données
$servername = "localhost";
$username = "sae23";
$password = "sae23";
$dbname = "sae23";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
} 
echo "Connexion réussie";

// Fermer la connexion
$conn->close();
?>

