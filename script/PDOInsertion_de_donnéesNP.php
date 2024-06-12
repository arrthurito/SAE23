<?php
$servername = "localhost";
$username = "sae23";
$password = "sae23";
$dbname = "sae23";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête d'insertion
    $sql = "INSERT INTO Capteurs (NomCapteur, Date, TypeCapt, Unites, Valeurs)
    VALUES ('Capteur Humidité 1', '2024-06-12', 'Humidité', '%', 45.0)";
    $conn->exec($sql);
    echo "Nouvel enregistrement créé avec succès";
}
catch(PDOException $e) {
    echo "Erreur: " . $sql . "<br>" . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>