<?php
include "../../../inc/init.php";

// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("Location: ". ROOT_URL ."public/auth/pages/login.php");
?>