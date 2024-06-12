<?php
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

// Requête d'insertion
$sql = "INSERT INTO Capteurs (NomCapteur, Date, TypeCapt, Unites, Valeurs)
VALUES ('Capteur Humidité 1', '2024-06-12', 'Humidité', '%', 45.0)";

if ($conn->query($sql) === TRUE) {
    echo "Nouvel enregistrement créé avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>