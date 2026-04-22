<?php
include("../config/auth.php");
include("../config/db.php");

if ($_SESSION['role'] !== 'admin') {
    die("Access Denied!");
}


$id = $_GET['id'];


$result = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $result->fetch_assoc();


if (isset($_POST['update'])) {

    $name  = $_POST['name'];
    $roll  = $_POST['roll'];
    $class = $_POST['class'];

    // Photo update
    if ($_FILES['photo']['name']) {

        $photo = time() . "_" . $_FILES['photo']['name'];

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "../uploads/" . $photo
        );

        $conn->query("UPDATE students 
                      SET photo='$photo' 
                      WHERE id=$id");
    }

    $conn->query("UPDATE students 
                  SET name='$name',
                      roll_no='$roll',
                      class='$class'
                  WHERE id=$id");

    header("Location: students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="POST" enctype="multipart/form-data">

    Name:
    <input type="text" name="name"
           value="<?= $student['name'] ?>" required>
    <br><br>

    Username:
    <input type="text" name="username"
           value="<?= $student['name'] ?>" required>
    <br><br>

    Roll No:
    <input type="text" name="roll"
           value="<?= $student['roll_no'] ?>" required>
    <br><br>

    Class:
    <input type="text" name="class"
           value="<?= $student['class'] ?>" required>
    <br><br>

    Current Photo:<br>

    <?php if($student['photo']): ?>
        <img src="../uploads/<?= $student['photo'] ?>" width="80"><br>
    <?php endif; ?>

    New Photo:
    <input type="file" name="photo">
    <br><br>

    <button name="update">Update</button>

</form>

</body>
</html>
