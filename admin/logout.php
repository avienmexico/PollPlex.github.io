<?php
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login or home page
header('Location: /VotingSystem/index.html');
exit(); // Ensure no other code is executed after the redirect
?>
