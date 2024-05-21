<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting to login page
        header("Location: login/login.php");
        exit();
    }
?>