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

// Prepare the selection query
$sql = "SELECT * FROM Mesures m INNER JOIN Capteurs c ON c.NomCapteur = m.NomCapteur";  //;
$result = $conn->query($sql);

if ($result === false) {
    die("Erreur dans la requête: " . $conn->error);
}

// Display data in an HTML table
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>TypeCapt</th><th>Valeurs</th><th>Unites</th><th>Horaires</th><th>Date</th><th>Nomcapteur</th></tr>";


    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["TypeCapt"] . "</td>";
        echo "<td>" . $row["Valeurs"] . "</td>";
        echo "<td>" . $row["Unites"] . "</td>";
        echo "<td>" . $row["Horaires"] . "</td>";
        echo "<td>" . $row["Date"] . "</td>";
        echo "<td>" . $row["NomCapteur"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Aucune donnée trouvée";
}

// Close connection
$conn->close();
?>