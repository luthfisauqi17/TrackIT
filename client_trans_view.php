<?php include("client_template/header.php"); 
    $user_name = $_SESSION["user_name"];
    $row_count = 1;
    include("config/db_connect.php");
    $sql = "SELECT * FROM  transactions WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>
    <h2 class="title">Transactions History</h2>

    <div class="table">
        <table>
        <tr>
            <td><h4>index</h4></td>
            <td><h4>Item Name</h4></td>
            <td><h4>Transaction Item Quantity</h4></td>
            <td><h4>Transaction Item Price</h4></td>
            <td><h4>Transaction Date</h4></td>
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
                </tr>
            <?php 
            }
            } else {
                echo "0 results";
            }
        ?>
        </table>
    </div>

<?php include("client_template/footer.php"); ?>