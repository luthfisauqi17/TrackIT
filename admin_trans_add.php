<?php    

    if(isset($_GET["delete"])) {
        include("config/db_connect.php");
        $pending_delete = $_GET["delete"];
        $sql_pending_delete = "DELETE FROM items_pending WHERE pending_id = '$pending_delete'";
        if(mysqli_query($conn, $sql_pending_delete)) echo "Data removed successfully";
        else echo "Error: " . $sql_pending_delete . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_trans_add.php");
    }

    if(isset($_POST["add-item"])) {
        include("config/db_connect.php");
        $pending_id = $_POST["item_id"];

        $sql_item_info = "SELECT * FROM items WHERE item_id = '$pending_id'";
        $result_item_info = mysqli_query($conn, $sql_item_info);
        $item = mysqli_fetch_assoc($result_item_info);

        $pending_item_name = $item["item_name"];
        $pending_quantity = $_POST["item_choosed_quantity"];
        $pending_item_availability = $item["item_remain"];
        
        
        $sql_items_pending_insert = "INSERT INTO items_pending(pending_item_id, pending_item_name, pending_item_quantity, pending_item_availability) 
                                        VALUES('$pending_id', '$pending_item_name', '$pending_quantity', '$pending_item_availability')";
        if (mysqli_query($conn, $sql_items_pending_insert)) echo "New record created successfully";
        else echo "Error: " . $sql_items_pending_insert . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_trans_add.php");
    }
    
    $row_count = 1;
    include("config/db_connect.php");
    $sql_items = "SELECT * FROM  items";
    $result_items = mysqli_query($conn, $sql_items);
    mysqli_close($conn);

?>

<?php include("admin_template/header.php"); ?>
<h2><img class='icon' src='static/icon/plus.png'>New Transaction: </h2>

    <form class="item-list-box" action="admin_trans_add.php" method="POST">
        <h3>Item List:</h3>
        <table>
            <tr>
                <td><h4>Item Name</h4></td>
                <td><h4>Your Quantity</h4></td>
            </tr>
            <tr>
                <td>
            <select name="item_id">
            <?php 
                while($row = mysqli_fetch_assoc($result_items)) {
                    echo "<option value=" . $row["item_id"] . ">" . $row["item_name"] . "</option>";
                }
            ?>
                </td>
                <td><input default='0' type="number" name="item_choosed_quantity"></td>
                <td><input type="submit" name="add-item" value="Add"></td>
            </tr>    
        </table>
    </form>

    <form class="your-cart-box">
        <h3>Your cart:</h3>
        <table width="100%">
        <tr>
            <td><h4>index</h4></td>
            <td><h4>Item id</h4></td>
            <td><h4>Item name</h4></td>
            <td><h4>Your  requested quantity</h4></td>
            <td><h4>Item availability</h4></td>
            <td><h4>Action</h4></td>
        </tr>
            <?php
                $row_count = 1;
                include("config/db_connect.php");
                $sql_pending_item_list = "SELECT * FROM items_pending";
                $result_pending_items = mysqli_query($conn, $sql_pending_item_list);
                while($row = mysqli_fetch_assoc($result_pending_items)) {
                    echo "<tr>";
                    echo "<td>" . $row_count++ . "</td>";
                    echo "<td>" . $row["pending_item_id"] . "</td>";
                    echo "<td>" . $row["pending_item_name"] . "</td>";
                    echo "<td>" . $row["pending_item_quantity"] . "</td>";
                    echo "<td>" . $row["pending_item_availability"] . "</td>"; ?>
                    <td><a onclick="return confirm('Do you want to delete this record?')" href="admin_trans_add.php?delete=<?= $row['pending_id'] ?>"><img class='icon' src='static/icon/eraser.png'></a></td>
                    <?php echo "</tr>";
                }
            ?>
        </table>
    </form>

</body>
</html>