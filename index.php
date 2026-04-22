<?php
include("config/auth.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Portal</title>
</head>
<body>

<h2>Welcome to Student Portal</h2>

<p>Hello, <?php echo $_SESSION['user']; ?></p>

<?php
if ($_SESSION['role'] == 'admin') {
    echo "<a href='admin/dashboard.php'>Go to Admin Panel</a><br><br>";
}
?>

<a href="auth/logout.php">Logout</a>


</body>
</html>
