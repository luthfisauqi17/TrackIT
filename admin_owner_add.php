<?php 
    if(isset($_POST["submit"])) {
        include("config/db_connect.php");
        $user_name = $_POST["user_name"];
        $user_password = $_POST["user_password"];

        $sql = "INSERT INTO users VALUES
            ('$user_name', '$user_password')";
        
        if (mysqli_query($conn, $sql)) echo "New record created successfully";
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_owner_view.php");
    }

?>

<?php include("admin_template/header.php"); ?>
    <form action="admin_owner_add.php" method="POST">
        <h2><img class='icon' src='static/icon/plus.png'>New Owner: </h2>
        <table>
            <tr>
                <td>User Name: </td>
                <td><input type="text" name="user_name"></td>
            </tr>
            <tr>
                <td>User Password: </td>
                <td><input class="input-medium" type="password" name="user_password"></td>
            </tr>
            <tr>
                <td><button type="submit" name="submit">Add</button></td>
            </tr>
        </table>
    </form>
<?php include("admin_template/footer.php"); ?>