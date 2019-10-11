<?php    

    $error = false;
    $total_price = 0;

    if(isset($_POST['proceed'])) {
        include("config/db_connect.php");
        $sql_all_pending = "SELECT * FROM items_pending";
        $result_all_pending = mysqli_query($conn, $sql_all_pending);
        while($row = mysqli_fetch_assoc($result_all_pending)) {
            $item_id = $row["pending_item_id"];
            $item_quantity = $row["pending_item_quantity"];
            $item_price = $row["pending_item_price"];
            // $trans_date = date("d/m/Y");
            $sql_insert_trans = "INSERT INTO transactions(trans_item_quantity, trans_item_price, item_id)
                                    VALUES('$item_quantity', '$item_price', '$item_id')";
            if (mysqli_query($conn, $sql_insert_trans)) echo "New record created successfully";
            else echo "Error: " . $sql_insert_trans . "<br>" . mysqli_error($conn);

            $sql_update_item = "UPDATE items SET item_sold = '$item_quantity' WHERE item_id = '$item_id'";
            if (mysqli_query($conn, $sql_update_item)) echo "New record updated successfully";
            else echo "Error: " . $sql_update_item . "<br>" . mysqli_error($conn);
        }
        $sql_clear_pending = "TRUNCATE TABLE items_pending";
        if(mysqli_query($conn, $sql_clear_pending)) {
            echo("All rows have been deleted.");
        }else{
            echo("No rows have been deleted.");
        }
        mysqli_close($conn);
        header("Location: admin_trans_view.php");
    } 

    if(isset($_GET["delete"])) {
        include("config/db_connect.php");
        $pending_delete = $_GET["delete"];

        $sql_pending_finder = "SELECT * FROM items_pending WHERE pending_id = '$pending_delete'";
        $result_pending_finder = mysqli_query($conn, $sql_pending_finder);
        $pending_found = mysqli_fetch_assoc($result_pending_finder);

        $item_id = $pending_found["pending_item_id"];

        $sql_item_finder = "SELECT * FROM items WHERE item_id = '$item_id'";
        $result_item_finder = mysqli_query($conn, $sql_item_finder);
        $item_found = mysqli_fetch_assoc($result_item_finder);

        $new_qty = $item_found['item_remain'] + $pending_found['pending_item_quantity'];

        $sql_item_update = "UPDATE items SET item_remain = '$new_qty' WHERE item_id = '$item_id'";
        if (mysqli_query($conn, $sql_item_update)) echo "New record updated successfully";
        else echo "Error: " . $sql_item_update . "<br>" . mysqli_error($conn);

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

        $pending_item_availability = $item["item_remain"] - $pending_quantity;

        $sql_update_qty = "UPDATE items SET item_remain = '$pending_item_availability' WHERE item_id = '$pending_id'";
        if (mysqli_query($conn, $sql_update_qty)) echo "New record updated successfully";
        else echo "Error: " . $sql_update_qty . "<br>" . mysqli_error($conn);

        $pending_item_price = $_POST["item_choosed_quantity"] * $item["item_price"];
        
        $sql_items_pending_insert = "INSERT INTO items_pending(pending_item_id, pending_item_name, pending_item_quantity, pending_item_availability, pending_item_price) 
                                        VALUES('$pending_id', '$pending_item_name', '$pending_quantity', '$pending_item_availability', '$pending_item_price')";
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

    <form class="your-cart-box" action="admin_trans_add.php" method="POST">
        <h3>Your cart:</h3>
        <table width="100%">
        <tr>
            <td><h4>index</h4></td>
            <td><h4>Item id</h4></td>
            <td><h4>Item name</h4></td>
            <td><h4>Your  requested quantity</h4></td>
            <td><h4>Item availability</h4></td>
            <td><h4>Price</h4></td>
            <td><h4>Action</h4></td>
        </tr>
            <?php
                $row_count = 1;
                include("config/db_connect.php");
                $sql_pending_item_list = "SELECT * FROM items_pending";
                $result_pending_items = mysqli_query($conn, $sql_pending_item_list);
                while($row = mysqli_fetch_assoc($result_pending_items)) {
                    if($row["pending_item_quantity"] == 0 || $row["pending_item_quantity"] > $row["pending_item_availability"]+1 || $row["pending_item_quantity"] < 0) {
                        $error = true;
                        echo "<tr class='bg-red'>";
                    }
                    else echo "<tr>";
                    echo "<td>" . $row_count++ . "</td>";
                    echo "<td>" . $row["pending_item_id"] . "</td>";
                    echo "<td>" . $row["pending_item_name"] . "</td>";
                    echo "<td>" . $row["pending_item_quantity"] . " item/s</td>";
                    echo "<td>" . $row["pending_item_availability"] . " item/s left</td>";
                    echo "<td>Rp." . $row["pending_item_price"] . "</td>"; 
                    $total_price += $row["pending_item_price"];
                    ?>
                    <td><a onclick="return confirm('Do you want to delete this record?')" href="admin_trans_add.php?delete=<?= $row['pending_id'] ?>"><img class='icon' src='static/icon/eraser.png'></a></td>
                    <?php echo "</tr>";
                }
            ?>
        </tr>
        </table>
        <div class="proceed-section">
            <ul>
                <li><?php echo "<td>Total price =<h3> Rp." . $total_price . "</h3></td>"?></li>
                <?php 
                    if($error == true) echo "<li><input type='submit' name='proceed' value='Proceed' disabled><p class='text-red'>*There are some error/s in your transaction</p></li>";
                    else echo "<li><input type='submit' name='proceed' value='Proceed'></li>";
                ?>
            </ul>
        </div>
    </form>

</body>
</html>