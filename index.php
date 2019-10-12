<?php
    if(isset($_POST["submit"])) {
        include("config/db_connect.php");
        $user_name = $_POST["user_name"];
        $user_password = $_POST["user_password"];
        $sql_login = "SELECT * FROM users WHERE user_name='$user_name' AND user_password='$user_password'";
        $result_login = mysqli_query($conn, $sql_login);
        if(mysqli_num_rows($result_login) > 0) {
            echo "Login successfull";
            header("Location: admin_inv_view.php");
        }
        else echo "No such username found or password is incorrect";
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="index.php" method="POST">
        <div class="container">
            <h1 class="title">Welcome Admin!</h1>
            <img class="img" src="login.png">
            <input name="user_name" class="text" type="text" placeholder="Username">
            <input name="user_password" class="password" type="password" placeholder="Password">
            <button name="submit" class="btn" type="submit">LOGIN</button>
        </div>
    </form>
</body>
</html>