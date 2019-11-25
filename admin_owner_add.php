<?php 
    if(isset($_GET["user_name"])) {
        include("config/db_connect.php");
        $user_name = $_GET["user_name"];
        $user_password = $_GET["user_password"];

        $sql = "INSERT INTO users VALUES
            ('$user_name', '$user_password')";
        
        if (mysqli_query($conn, $sql)) echo "New record created successfully";
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_owner_view.php");
    }

?>

<?php include("admin_template/header.php"); ?>

    <h2><img class='icon' src='static/icon/plus.png'>New Owner: </h2>
    <table>
        <tr>
            <td>User Name: </td>
            <td><input id="user_name" type="text" name="user_name"></td>
        </tr>
        <tr>
            <td>User Password: </td>
            <td><input id="user_password" class="input-medium" type="password" name="user_password"></td>
        </tr>
        <tr>
            <td><button onclick="newUserAjax();" type="submit" name="submit">Add</button></td>
        </tr>
    </table>

    <div id="res"></div>

<?php include("admin_template/footer.php"); ?>

<script>
    function newUserAjax() {
        user_name = document.getElementById("user_name").value;
        user_password = document.getElementById("user_password").value;

        x = new XMLHttpRequest();
        x.open("GET","admin_owner_add.php?user_name="+user_name+"&user_password="+user_password, true) 
        x.send();
        x.onreadystatechange=stateChanged;
    }

    function stateChanged() { 
        if (x.readyState==4) { 
            document.getElementById("res").innerHTML = "Data inserted successfully";
        }
    }
</script>