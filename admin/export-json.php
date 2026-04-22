<?php
include("../config/auth.php");
include("../config/db.php");

if ($_SESSION['role'] !== 'admin') {
    die("Access Denied!");
}

$res = $conn->query("SELECT * FROM students");

$data = [];

while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}

header("Content-Type: application/json");

echo json_encode($data, JSON_PRETTY_PRINT);
?>