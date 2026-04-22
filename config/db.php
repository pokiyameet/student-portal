<?php
require_once(__DIR__ . "/../classes/Database.php");

try {
    $db = new Database();
    $conn = $db->connect();
} catch (Exception $e) {
    die($e->getMessage());
}


