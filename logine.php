<?php
session_start(); // Start the session to manage user session data

$_SESSION["login"] = $_REQUEST["login"]; // Retrieve login from request and store in session
$_SESSION["mdp"] = $_REQUEST["mdp"];     // Retrieve password from request and store in session
$login = $_SESSION["login"];
$motdep = $_SESSION["mdp"];
$_SESSION["auth"] = FALSE; // Initialize session variable for authentication status

// Check if login or password is empty
if (empty($login) || empty($motdep)) {
    header("Location: erreur.html"); // Redirect to error page if either login or password is empty
} else {
    /* Access the database */
    include("mysql.php"); // Include the file for database connection

    // Retrieve password from database
    $requete_mdp = "SELECT `mdp` FROM `Administration` WHERE `IDBat` = 'E'";
    $resultat_mdp = mysqli_query($id_bd, $requete_mdp)
        or die("Execution de la requête impossible : $requete_mdp");
    $ligne_row = mysqli_fetch_row($resultat_mdp);

    // Retrieve login from database
    $requete_login = "SELECT `login` FROM `Administration` WHERE `ligne` = 'E'";
    $resultat_login = mysqli_query($id_bd, $requete_login)
        or die("Execution de la requête impossible : $requete_login");
    $ligne_assoc = mysqli_fetch_assoc($resultat_login);

    // Check if password and login match
    if ($motdep == $ligne_row[0] && $login == $ligne_assoc['login']) {
        $_SESSION["auth"] = TRUE; // Set authentication status to true
        mysqli_close($id_bd); // Close database connection
        echo "<script type='text/javascript'>document.location.replace('choix_type.php');</script>"; // Redirect to another page on successful login
    } else {
        $_SESSION = array(); // Reset session array
        session_destroy();   // Destroy the session
        unset($_SESSION);    // Unset session array
        mysqli_close($id_bd); // Close database connection
        echo "<script type='text/javascript'>document.location.replace('login_error.php');</script>"; // Redirect to login error page on failed login
    }
}
?>
