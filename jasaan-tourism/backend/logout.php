<?php
    session_start();

    // UNSET ALL SESSION VARIABLES
    $_SESSION = [];

    // DESTROY SESSION
    session_destroy();

    // REDIRECT TO HOME / LOGIN PAGE
    header("Location: /jasaan-tourism/frontend/pages/user/user_explore.php");
    exit;
?>