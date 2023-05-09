<?php
// start the session
session_start();

// unset all session variables
session_unset();

// destroy the session
session_destroy();

?>

<script>
    window.location.href = "index.html";// redirect to the login page
</script>
