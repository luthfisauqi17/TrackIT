<?php
    if(isset($_GET['delete'])) {
        include("config/db_connect.php");
        $itm_id = $_GET['delete'];
        $sql_delete = "DELETE FROM items WHERE item_id='$itm_id'";
        $stmt = $conn->prepare($sql_delete);
        $stmt->execute();
        mysqli_close($conn);
    }

    if(isset($_GET['edit'])) {
        include("config/db_connect.php");

    }

    $row_count = 1;
    include("config/db_connect.php");
    $sql = "SELECT * FROM  items";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>

<?php include("admin_template/header.php"); ?>

    <h2 class="title">Inventory Information</h2>

    <div class="table">
        <table>
        <tr>
            <td><h4>index</h4></td>
            <td><h4>Item Id</h4></td>
            <td><h4>Item Name</h4></td>
            <td><h4>Item Quantity</h4></td>
            <td><h4>Item Price</h4></td>
            <td><h4>Item Sold</h4></td>
            <td><h4>Item Status</h4></td>
            <td><h4>Vendor Id</h4></td>
            <td><h4>Actions</h4></td>
        </tr>
        <?php 
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row_count % 2 == 1) echo "<tr class='bg-lightgray'>";
                else echo "<tr>";
                echo "<td>" . $row_count++ . "</td>";
                echo "<td>" . $row["item_id"] . "</td>";
                echo "<td>" . $row["item_name"] . "</td>";
                echo "<td>" . $row["item_remain"] . "</td>";
                echo "<td>" . $row["item_price"] . "</td>";
                echo "<td>" . $row["item_sold"] . "</td>";
                echo "<td>" . $row["item_status"] . "</td>";
                echo "<td>" . $row["vendor_id"] . "</td>";
                ?>
                <td><a href="admin_inv_edit.php?edit=<?= $row['item_id'] ?>"><img class='icon' src='static/icon/edit.png'></a> 
                    <a onclick="return confirm('Do you want to delete this record?')" href="admin_inv_view.php?delete=<?= $row['item_id'] ?>"><img class='icon' src='static/icon/eraser.png'></a></td>
                </tr>
            <?php 
            }
            } else {
                echo "0 results";
            }
        ?>
        </table>
        <a href="admin_inv_add.php"><img class="icon" src="static/icon/plus.png" alt="">Add New Item</a>
    </div>

<?php include("admin_template/footer.php"); ?>