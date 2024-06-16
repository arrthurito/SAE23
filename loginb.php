<?php
session_start(); // Start or resume session

// Assigning login and password received from request to session variables
$_SESSION["login"] = $_REQUEST["login"]; // Retrieving login from request
$_SESSION["mdp"] = $_REQUEST["mdp"];     // Retrieving password from request

$login = $_SESSION["login"];
$motdep = $_SESSION["mdp"];

$_SESSION["auth"] = FALSE; // Initialize authentication status as false

// Check if login or password is empty
if (empty($login) || empty($motdep)) {
    header("Location: erreur.html"); // Redirect to error page if either is empty
} else {
    /* Accessing the database */
    include("mysql.php"); // Including database connection file

    // Retrieving password from database
    $requete_mdp = "SELECT `mdp` FROM `Administration` WHERE `IDBat` = 'B'";
    $resultat_mdp = mysqli_query($id_bd, $requete_mdp)
        or die("Execution de la requête impossible : $requete_mdp");
    $ligne_row = mysqli_fetch_row($resultat_mdp);

    // Retrieving login from database
    $requete_login = "SELECT `login` FROM `Administration` WHERE `ligne` = 'B'";
    $resultat_login = mysqli_query($id_bd, $requete_login)
        or die("Execution de la requête impossible : $requete_login");
    $ligne_assoc = mysqli_fetch_assoc($resultat_login);

    // Checking if password and login match
    if ($motdep == $ligne_row[0] && $login == $ligne_assoc['login']) {
        $_SESSION["auth"] = TRUE; // Authentication successful
        mysqli_close($id_bd); // Closing database connection
        echo "<script type='text/javascript'>document.location.replace('choix_type.php');</script>"; // Redirecting to another page upon successful login
    } else {
        $_SESSION = array(); // Resetting session array
        session_destroy();   // Destroying session
        unset($_SESSION);    // Unsetting session array
        mysqli_close($id_bd); // Closing database connection
        echo "<script type='text/javascript'>document.location.replace('login_error.php');</script>"; // Redirecting to login error page upon failed login
    }
}
?>
