<?php include("client_template/header.php");
    $row_count = 1;
    include("config/db_connect.php");
    $user_name = $_SESSION["user_name"];
    $sql = "SELECT * FROM  items WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $sql);
    $result_worth = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>



    <h2 class="title">Inventory Information</h2>

    <div class="items-info-box">
        <div class="inv_worth">
            <?php 
                $worth_value = 0;
                $worth_total_item = 0;
                while($row_worth = mysqli_fetch_assoc($result_worth)) {
                    $worth_value += $row_worth["item_price"] * $row_worth["item_remain"];
                    $worth_total_item += $row_worth["item_remain"];
                }
                echo "<h3>Total Inventory Value:</h3>";
                echo "<h3 class='inv_value'>Rp." . $worth_value . "</h3>";
            ?>
        </div>

        <div class="inv_worth">
            <?php
                echo "<h3>Total Inventory Items:</h3>";
                echo "<h3 class='inv_value'>" . $worth_total_item . " Item/s</h3>";
            ?>
        </div>
    </div>
    

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
                echo "<td>Rp." . $row["item_price"] . "</td>";
                echo "<td>" . $row["item_sold"] . "</td>";
                echo "<td>" . $row["item_status"] . "</td>";
                echo "<td>" . $row["vendor_id"] . "</td>";
            }
            } else {
                echo "0 results";
            }
        ?>
        </table>
    </div>

<?php include("client_template/footer.php"); ?>