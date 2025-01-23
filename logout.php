<?php 
    // Start the session to access session variables
    session_start();

    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the home page (index.php) after logging out
    header('location:index.php');
?>
