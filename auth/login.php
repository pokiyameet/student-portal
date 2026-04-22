<?php
session_start();
include("../config/db.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email=?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $res = $stmt->get_result();


    if ($res->num_rows == 1) {

        $user = $res->fetch_assoc();

        if (password_verify($pass, $user['password'])) {

            $_SESSION['user'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../index.php");
            exit();

        } else {
            $error = "Wrong Password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>

    <h2>Login</h2>

    <?php if (isset($error))
        echo "<p style='color:red'>$error</p>"; ?>

    <form method="POST">

        Email: <input type="email" name="email" required><br><br>

        Password: <input type="password" name="password" required><br><br>

        <button name="login">Login</button>

    </form>

</body>

</html>