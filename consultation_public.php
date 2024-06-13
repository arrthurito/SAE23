<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>SAE23</title> <!-- À changer -->
    <link rel="stylesheet" href="styles/habillage.css">
    <link rel="icon" href="images/Logo_IUT_Blagnac.png">
    <style>
        /* Ajouter du style CSS ici si nécessaire */
    </style>
</head>
<body>
    <header>
        <h1>Données des batiments</h1>
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="consultation_public.php">Consultations des données</a></li>
                <li><a href="Gestion_de_projet.html">Gestions de projets</a></li>
                <li><a href="mention_legal.html">Mentions légales</a></li>
            </ul>
        </nav>
        <a class="admin" href="login.html">Admin</a>
        <a class="B" href="login_gest_b.html">Gestionnaire du batiment B</a>
        <a class="E" href="login_gest_e.html">Gestionnaire du batiment E</a>
    </header>
<?php
$servername = "localhost";
$username = "sae23";
$password = "sae23";
$dbname = "sae23";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Function to execute query and display data in a table
function executeQueryAndDisplay($conn, $sql, $tableHeader)
{
    $result = $conn->query($sql);

    if ($result === false) {
        die("Erreur dans la requête: " . $conn->error);
    }

    // Display data in an HTML table
    if ($result->num_rows > 0) {
        echo "<table class='data-table' border='1'>";
        echo "<caption>$tableHeader</caption>";
        echo "<tr>";
        foreach ($tableHeader as $header) {
            echo "<th>$header</th>";
        }
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucune donnée trouvée pour $tableHeader";
    }
}

// Query for humidité data
$sqlHumidite = "SELECT m.TypeCapt, m.Valeurs, m.Unites, m.Horaires, m.Date, m.NomCapteur
                FROM Mesures m 
                INNER JOIN Capteurs c ON c.NomCapteur = m.NomCapteur 
                WHERE c.TypeCapt='humidite' AND (c.NomSalles='B103' OR c.NomSalles='B105')
                ORDER BY m.Date DESC
                LIMIT 1";
$tableHeaderHumidite = ["TypeCapt", "Valeurs", "Unites", "Horaires", "Date", "Nomcapteur"];
executeQueryAndDisplay($conn, $sqlHumidite, "Humidité");

// Query for luminosité data
$sqlLuminosite = "SELECT m.TypeCapt, m.Valeurs, m.Unites, m.Horaires, m.Date, m.NomCapteur
                FROM Mesures m 
                INNER JOIN Capteurs c ON c.NomCapteur = m.NomCapteur 
                WHERE c.TypeCapt='luminosite' AND (c.NomSalles='B103' OR c.NomSalles='B105')
                ORDER BY m.Date DESC
                LIMIT 1";
$tableHeaderLuminosite = ["TypeCapt", "Valeurs", "Unites", "Horaires", "Date", "Nomcapteur"];
executeQueryAndDisplay($conn, $sqlLuminosite, "Luminosité");

// Close connection
$conn->close();
?>
</body>
</html>
