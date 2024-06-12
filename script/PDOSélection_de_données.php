<?php
$servername = "localhost";
$username = "sae23";
$password = "sae23";
$dbname = "sae23";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête de sélection
    $stmt = $conn->prepare("SELECT IDMes, NomCapteur, Date, TypeCapt, Unites, Valeurs FROM Capteurs");
    $stmt->execute();

    // Afficher les résultats
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach($stmt->fetchAll() as $row) {
        echo "ID: " . $row["IDMes"]. " - Capteur: " . $row["NomCapteur"]. " - Date: " . $row["Date"]. " - Type: " . $row["TypeCapt"]. " - Unité: " . $row["Unites"]. " - Valeur: " . $row["Valeurs"]. "<br>";
    }
}
catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>