<?php
// start the session
session_start();

// unset all session variables
session_unset();

// destroy the session
session_destroy();

// redirect to the login page
header("Location: index.html");
exit;
