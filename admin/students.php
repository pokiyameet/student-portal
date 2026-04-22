<?php
include("../config/auth.php");
include("../config/db.php");


if ($_SESSION['role'] !== 'admin') {
    die("Access Denied!");
}

$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$limit = 5;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $limit;


$sql = "SELECT * FROM students 
        WHERE name LIKE '%$search%'
        OR roll_no LIKE '%$search%'
        ORDER BY id DESC
        LIMIT $start, $limit";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Students</title>
</head>

<body>

    <h2>Students List</h2>

    <form method="GET">

        <input type="text" name="search" placeholder="Search by name or roll">

        <button>Search</button>

    </form>

    <br>

    <a href="add-student.php">+ Add Student</a>
    <br><br>

    <table border="1" cellpadding="8">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Class</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>

            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['roll_no'] ?></td>
                <td><?= $row['class'] ?></td>
                <td>
                    <?php if ($row['photo']): ?>
                        <img src="../uploads/<?= $row['photo'] ?>" width="50">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit-student.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete-student.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>

        <?php endwhile; ?>

    </table>

    <br>
    <a href="dashboard.php">Back <-</a>

    <?php

    $total = $conn->query("SELECT COUNT(*) AS total FROM students")
        ->fetch_assoc()['total'];

    $pages = ceil($total / $limit);

    for ($i = 1; $i <= $pages; $i++) {

        echo "<a href='?page=$i'> $i </a> ";
    }
    ?>


</body>

</html>