<?php
    if(isset($_GET['delete'])) {
        include("config/db_connect.php");
        $trans_id = $_GET['delete'];
        $sql_delete = "DELETE FROM transactions WHERE trans_id='$trans_id'";
        $stmt = $conn->prepare($sql_delete);
        $stmt->execute();
        mysqli_close($conn);
        header("Location: admin_trans_view.php");
    }

    if(isset($_GET['edit'])) {
        include("config/db_connect.php");

    }

    $row_count = 1;
    include("config/db_connect.php");
    $sql = "SELECT * FROM  transactions";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>

<?php include("admin_template/header.php"); ?>

    <h2 class="title">Transactions History</h2>

    <div class="table">
        <table>
        <tr>
            <td><h4>index</h4></td>
            <td><h4>Item Name</h4></td>
            <td><h4>Transaction Item Quantity</h4></td>
            <td><h4>Transaction Item Price</h4></td>
            <td><h4>Transaction Date</h4></td>
            <td><h4>Actions</h4></td>
        </tr>
        <?php 
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row_count % 2 == 1) echo "<tr class='bg-lightgray'>";
                else echo "<tr>";

                include("config/db_connect.php");
                $item_id = $row["item_id"];
                $sql_find_item = "SELECT * FROM items WHERE item_id = '$item_id'";
                $result_find_item = mysqli_query($conn, $sql_find_item);
                mysqli_close($conn);

                $item = mysqli_fetch_assoc($result_find_item);

                echo "<td>" . $row_count++ . "</td>";
                echo "<td>" . $item["item_name"] . "</td>";
                echo "<td>" . $row["trans_item_quantity"] . " item/s</td>";
                echo "<td>" . $row["trans_item_price"] . "</td>";
                echo "<td>" . $row["trans_date"] . "</td>";
                ?>
                <td><a href="admin_inv_edit.php?edit=<?= $row['item_id'] ?>"><img class='icon' src='static/icon/edit.png'></a> 
                    <a onclick="return confirm('Do you want to delete this record?')" href="admin_trans_view.php?delete=<?= $row['trans_id'] ?>"><img class='icon' src='static/icon/eraser.png'></a></td>
                </tr>
            <?php 
            }
            } else {
                echo "0 results";
            }
        ?>
        </table>
        <a href="admin_trans_add.php"><img class="icon" src="static/icon/plus.png" alt="">Add New Transaction</a>
    </div>

<?php include("admin_template/footer.php"); ?>