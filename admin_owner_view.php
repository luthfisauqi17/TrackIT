<?php
    if(isset($_GET['delete'])) {
        include("config/db_connect.php");
        $user_name = $_GET['delete'];
        $sql_delete = "DELETE FROM users WHERE user_name='$user_name'";
        $stmt = $conn->prepare($sql_delete);
        $stmt->execute();
        mysqli_close($conn);
    }

    $row_count = 1;
    include("config/db_connect.php");
    $sql_user = "SELECT * FROM  users";
    $result_user = mysqli_query($conn, $sql_user);
    mysqli_close($conn);
?>

<?php include("admin_template/header.php"); ?>

    <h2 class="title">Owner Information</h2>    

    <div class="table">
        <table>
        <tr>
            <td><h4>index</h4></td>
            <td><h4>Username</h4></td>
            <td><h4>Password</h4></td>
        </tr>
        <?php 
            if (mysqli_num_rows($result_user) > 0) {
            while($row = mysqli_fetch_assoc($result_user)) {
                if($row_count % 2 == 1) echo "<tr class='bg-lightgray'>";
                else echo "<tr>";
                echo "<td>" . $row_count++ . "</td>";
                echo "<td>" . $row["user_name"] . "</td>";
                echo "<td>" . $row["user_password"] . "</td>";
                ?>
                <td><a href="admin_owner_edit.php?edit=<?= $row['user_name'] ?>"><img class='icon' src='static/icon/edit.png'></a> 
                    <a onclick="return confirm('Do you want to delete this record?')" href="admin_owner_view.php?delete=<?= $row['user_name'] ?>"><img class='icon' src='static/icon/eraser.png'></a></td>
                </tr>
            <?php 
            }
            } else {
                echo "0 results";
            }
        ?>
        </table>
        <a href="admin_owner_add.php"><img class="icon" src="static/icon/plus.png" alt="">Add New Owner</a>
    </div>

<?php include("admin_template/footer.php"); ?>