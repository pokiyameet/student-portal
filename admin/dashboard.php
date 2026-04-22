<?php
include("../config/auth.php");

if ($_SESSION['role'] !== 'admin') {
    die("Access Denied!");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>

<p>Welcome, <?php echo $_SESSION['user']; ?> (Admin)</p>

<hr>

<ul>
    <li><a href="export-json.php">Export Students (JSON)</a></li>
    <li><a href="students.php">Manage Students</a></li>
    <li><a href="../index.php">Home</a></li>
</ul>

</body>
</html>
