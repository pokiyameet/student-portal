<?php
include("../config/auth.php");
include("../config/db.php");

if ($_SESSION['role'] !== 'admin') {
    die("Access Denied!");
}

if (isset($_POST['save'])) {

    $name  = $_POST['name'];
    $roll  = $_POST['roll'];
    $class = $_POST['class'];

    // Upload photo
    $photo = "";

    if ($_FILES['photo']['name']) {

        $photo = time() . "_" . $_FILES['photo']['name'];

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "../uploads/" . $photo
        );
    }

    $sql = "INSERT INTO students (name,roll_no,class,photo)
            VALUES ('$name','$roll','$class','$photo')";

    $conn->query($sql);

    header("Location: students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST" enctype="multipart/form-data">

    Name: <input type="text" name="name" required><br><br>

    Roll No: <input type="text" name="roll" required><br><br>

    Class: <input type="text" name="class" required><br><br>

    Photo: <input type="file" name="photo"><br><br>

    <button name="save">Save</button>

</form>

</body>
</html>
