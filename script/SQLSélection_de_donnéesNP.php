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

// Requête de sélection
$sql = "SELECT IDMes, NomCapteur, Date, TypeCapt, Unites, Valeurs FROM Capteurs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les résultats
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["IDMes"]. " - Capteur: " . $row["NomCapteur"]. " - Date: " . $row["Date"]. " - Type: " . $row["TypeCapt"]. " - Unité: " . $row["Unites"]. " - Valeur: " . $row["Valeurs"]. "<br>";
    }
} else {
    echo "0 résultats";
}

// Fermer la connexion
$conn->close();
?>