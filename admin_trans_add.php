<?php 
    
    $row_count = 1;
    include("config/db_connect.php");
    $sql_items = "SELECT * FROM  items";
    $result_items = mysqli_query($conn, $sql_items);
    mysqli_close($conn);

?>

<?php include("admin_template/header.php"); ?>
<h2><img class='icon' src='static/icon/plus.png'>New Transaction: </h2>
<form class="transaction-box">

    <div class="item-list-box">
        <h3>Item List:</h3>
        <table>
            <tr>
                <td><h4>Item Name</h4></td>
                <td><h4>Item Avability</h4></td>
                <td><h4>Your Quantity</h4></td>
            </tr>
            <tr>
                <td>
                    <select>
            <?php
            
                if (mysqli_num_rows($result_items) > 0) {
                    while($item = mysqli_fetch_assoc($result_items)) {?>
                        <option value="<?= $item['item_id'] ?>"><?= $item['item_name'] ?></option>
                <?php
                    }
                } else {
                    echo "0 results";
                }
            ?>
                    </select>
                </td>
                <td>
                <?php
            
                    if (mysqli_num_rows($result_items) > 0) {
                        while($item = mysqli_fetch_assoc($result_items)) {
                            echo $item['item_remain'];
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
                </td>
                <td><input type="number" name="item_choosed_quantity"></td>
            </tr>    
        </table>
    </div>

    <div class="your-cart-box">
        <h3>Your Transactions History:</h3>
    </div>

</form>
</body>
</html>