<?php
include("../config/auth.php");
include("../config/db.php");

if ($_SESSION['role'] !== 'admin') {
    die("Access Denied!");
}

$id = $_GET['id'];

// Get photo
$res = $conn->query("SELECT photo FROM students WHERE id=$id");
$row = $res->fetch_assoc();

if ($row['photo']) {
    unlink("../uploads/" . $row['photo']);
}

$conn->query("DELETE FROM students WHERE id=$id");

header("Location: students.php");
exit();
