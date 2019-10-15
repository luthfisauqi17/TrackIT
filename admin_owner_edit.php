<?php 

    $user_name = $_GET['edit'];

    if(isset($_POST["submit"])) {
        include("config/db_connect.php");
        $user_name = $_POST["user_name"];
        $user_password = $_POST["user_password"];
        

        $sql_update =  
                    "UPDATE users 
                    SET user_password = '$user_password' 
                    WHERE user_name='$user_name'";
        
        if (mysqli_query($conn, $sql_update)) echo "New record updated successfully";
        else echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_owner_view.php");
    }

    include("config/db_connect.php");
    $sql_vendor = "SELECT * FROM vendors";
    $result_vendor = mysqli_query($conn, $sql_vendor);
    mysqli_close($conn);

?>

<?php include("admin_template/header.php"); ?>
    <form action="admin_owner_edit.php" method="POST">
        <h2><img class='icon' src='static/icon/edit.png'>Change password: </h2>
        <input type="hidden" name="user_name" value="<?= $user_name ?>">
        <table>
            <tr>
                <td>New Password: </td>
                <td><input class="input-medium" type="text" name="user_password"></td>
            </tr>
            <tr>
                <td><button type="submit" name="submit">Add</button></td>
            </tr>
        </table>
    </form>
<?php include("admin_template/footer.php"); ?>