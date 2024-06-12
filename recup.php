<?php
// Informations de connexion à la base de données
$host = 'localhost192.168.42.65'; // ou l'adresse IP du serveur MySQL
$dbname = 'sae23';
$username = 'bada';
$password = 'PassadInfo';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Définir le mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Exécution d'une requête SQL pour récupérer l'identifiant et le mot de passe
    $query = "SELECT identifiant, mot_de_passe FROM ma_table";
    $statement = $pdo->query($query);

    // Traitement des résultats
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        // Affichage de l'identifiant et du mot de passe
        echo "Identifiant: " . $row['identifiant'] . ", Mot de passe: " . $row['mot_de_passe'] . "<br>";
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion ou d'exécution de la requête, affichez l'erreur
    echo "Erreur : " . $e->getMessage();
}
?>
