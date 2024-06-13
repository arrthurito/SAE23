<!DOCTYPE html>
<html lang="fr">
    
    <title>SAE23</title> <!--à changer -->
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/habillage.css">
        <link rel="icon" href="images/Logo_IUT_Blagnac.png">
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
        
        // Prepare the selection query
        $sql = "SELECT * FROM Mesures m INNER JOIN Capteurs c ON c.NomCapteur = m.NomCapteur WHERE c.TypeCapt='humidite' AND (c.NomSalles='B103' OR c.NomSalles='B105');";  //;
        $result = $conn->query($sql);
        
        if ($result === false) {
            die("Erreur dans la requête: " . $conn->error);
        }
        
        // Display data in an HTML table
        if ($result->num_rows > 0) {
            echo "<table class='data-table' border='1'>";
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

        $sql = "SELECT * FROM Mesures m INNER JOIN Capteurs c ON c.NomCapteur = m.NomCapteur WHERE c.TypeCapt='luminosite' AND (c.NomSalles='B103' OR c.NomSalles='B105');";  //;
        $result = $conn->query($sql);
        
        if ($result === false) {
            die("Erreur dans la requête: " . $conn->error);
        }
        
        // Display data in an HTML table
        if ($result->num_rows > 0) {
            echo "<table class='data-table' border='1'>";
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
        
        $sql = "SELECT MIN(Valeurs),MAX(Valeurs),AVG(Valeurs) FROM Mesures m INNER JOIN Capteurs c ON c.NomCapteur = m.NomCapteur WHERE c.TypeCapt='luminosite' AND (c.NomSalles='B103' OR c.NomSalles='B105');";  //;
        $result = $conn->query($sql);
        
        if ($result === false) {
            die("Erreur dans la requête: " . $conn->error);
        }
        
        // Display data in an HTML table
        if ($result->num_rows > 0) {
            echo "<table class='data-table' border='1'>";
            echo "<tr><th>min</th><th>moy</th><th>max</th></tr>";
        
        
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["MIN(Valeurs)"] . "</td>";
                echo "<td>" . $row["AVG(Valeurs)"] . "</td>";
                echo "<td>" . $row["MAX(Valeurs)"] . "</td>";
                echo "</tr>";
            }
        
            echo "</table>";
        } else {
            echo "Aucune donnée trouvée";
        }

        $sql = "SELECT MIN(Valeurs),MAX(Valeurs),AVG(Valeurs) FROM Mesures m INNER JOIN Capteurs c ON c.NomCapteur = m.NomCapteur WHERE c.TypeCapt='humidite' AND (c.NomSalles='B103' OR c.NomSalles='B105');";  //;
        $result = $conn->query($sql);
        
        if ($result === false) {
            die("Erreur dans la requête: " . $conn->error);
        }
        
        // Display data in an HTML table
        if ($result->num_rows > 0) {
            echo "<table class='data-table' border='1'>";
            echo "<tr><th>min</th><th>moy</th><th>max</th></tr>";
        
        
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["MIN(Valeurs)"] . "</td>";
                echo "<td>" . $row["AVG(Valeurs)"] . "</td>";
                echo "<td>" . $row["MAX(Valeurs)"] . "</td>";
                echo "</tr>";
            }
        
            echo "</table>";
        } else {
            echo "Aucune donnée trouvée";
        }

        // Close connection
        $conn->close();
        ?>
        
    </body>

</html>