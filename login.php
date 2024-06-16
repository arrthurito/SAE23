<?php
session_start(); // Start or resume a session

$_SESSION["login"] = $_REQUEST["login"]; // Retrieve login from request and store in session
$_SESSION["mdp"] = $_REQUEST["mdp"];     // Retrieve password from request and store in session
$login = $_SESSION["login"];              // Retrieve login from session
$motdep = $_SESSION["mdp"];               // Retrieve password from session
$_SESSION["auth"] = FALSE;               // Initialize authentication status as false

// Check if login or password is empty
if (empty($login) || empty($motdep)) {
    header("Location: erreur.html"); // Redirect to error page if either login or password is empty
} else {
    /* Access the database */
    include("mysql.php"); // Include database connection file

    // Retrieve password from database
    $requete_mdp = "SELECT `mdp` FROM `Administration`";
    $resultat_mdp = mysqli_query($id_bd, $requete_mdp)
        or die("Execution de la requête impossible : $requete_mdp");
    $ligne_row = mysqli_fetch_row($resultat_mdp);

    // Retrieve login from database
    $requete_login = "SELECT `login` FROM `Administration`";
    $resultat_login = mysqli_query($id_bd, $requete_login)
        or die("Execution de la requête impossible : $requete_login");
    $ligne_assoc = mysqli_fetch_assoc($resultat_login);

    // Check if password and login match
    if ($motdep == $ligne_row[0] && $login == $ligne_assoc['login']) {
        $_SESSION["auth"] = TRUE; // Set authentication status to true
        mysqli_close($id_bd); // Close database connection
        echo "<script type='text/javascript'>document.location.replace('choix_type.php');</script>"; // Redirect to 'choix_type.php'
    } else {
        $_SESSION = array();   // Reset session array
        session_destroy();     // Destroy session
        unset($_SESSION);      // Unset session array
        mysqli_close($id_bd); // Close database connection
        echo "<script type='text/javascript'>document.location.replace('login_error.php');</script>"; // Redirect to 'login_error.php'
    }
}
?>
