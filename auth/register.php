<?php
session_start();
include("../config/db.php");

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $pass = trim($_POST['password']);

    if (!$email) {
        $error = "Invalid Email!";
    }
    if (!isset($error)) {

        $password = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (name,email,password) VALUES (?,?,?)"
        );

        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {

            $_SESSION['user'] = $name;
            header("Location: ../index.php");
            exit();

        } else {
            $error = "Email already exists!";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h2>Register</h2>

    <?php if (isset($error))
        echo "<p style='color:red'>$error</p>"; ?>

    <form method="POST">

        Name: <input type="text" name="name" required><br><br>

        Email: <input type="email" name="email" required><br><br>

        Password: <input type="password" name="password" required><br><br>

        <button name="register">Register</button>

    </form>

</body>

</html>