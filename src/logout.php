<?php 
// Destroy the session when logout button is clicked
session_start();
session_destroy();
header("Location: /src/login.html");
exit();
?>