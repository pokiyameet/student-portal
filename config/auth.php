<?php
session_start();

// If user not logged in
if (!isset($_SESSION['user'])) {
    header("Location: /student-portal/auth/login.php");
    exit();
}
