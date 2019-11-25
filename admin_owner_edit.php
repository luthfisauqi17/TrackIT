<?php 

    $user_name = $_GET['edit'];

    if(isset($_GET["user_name"])) {
        include("config/db_connect.php");
        $user_name = $_GET["user_name"];
        $user_password = $_GET["user_password"];
        

        $sql_update = "UPDATE users SET user_password = '$user_password' WHERE user_name='$user_name'";
        
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

    <h2><img class='icon' src='static/icon/edit.png'>Change password: </h2>
    <input id="user_name" type="hidden" name="user_name" value="<?= $user_name ?>">
    <table>
        <tr>
            <td>New Password: </td>
            <td><input id="user_password" class="input-medium" type="text" name="user_password"></td>
        </tr>
        <tr>
            <td><button onclick="editOwnerAjax();" type="submit" name="submit">Add</button></td>
        </tr>
    </table>

    <div id="res"></div>

<?php include("admin_template/footer.php"); ?>

<script>
    function editOwnerAjax() {
        user_name = document.getElementById("user_name").value;
        user_password = document.getElementById("user_password").value;

        x = new XMLHttpRequest();
        x.open("GET","admin_owner_edit.php?user_name="+user_name+"&user_password="+user_password, true) 
        x.send();
        x.onreadystatechange=stateChanged;
    }

    function stateChanged() { 
        if (x.readyState==4) { 
            document.getElementById("res").innerHTML = "Data updated successfully";
        }
    }
</script>