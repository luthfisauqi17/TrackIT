<?php 
    if(isset($_POST["submit"])) {
        include("config/db_connect.php");
        $item_id = $_POST["item_id"];
        $item_name = $_POST["item_name"];
        $item_remain = $_POST["item_remain"];
        $item_price = $_POST["item_price"];
        $item_sold = 0;
        $item_status = "ACTIVE";
        $vendor_id = $_POST["vendor_id"];

        $sql = "INSERT INTO items VALUES
            ('$item_id', '$item_name', '$item_remain', '$item_price', '$item_sold', '$item_status', '$vendor_id')";
        
        if (mysqli_query($conn, $sql)) echo "New record created successfully";
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_inv_view.php");
    }

    include("config/db_connect.php");
    $sql_vendor = "SELECT * FROM vendors";
    $result_vendor = mysqli_query($conn, $sql_vendor);
    mysqli_close($conn);

?>

<?php include("admin_template/header.php"); ?>
    <form action="admin_inv_add.php" method="POST">
        <h2><img class='icon' src='static/icon/plus.png'>New Item: </h2>
        <table>
            <tr>
                <td>Item Id: </td>
                <td><input type="text" name="item_id"></td>
            </tr>
            <tr>
                <td>Item Name: </td>
                <td><input class="input-medium" type="text" name="item_name"></td>
            </tr>
            <tr>
                <td>Item Quantity: </td>
                <td><input type="text" name="item_remain"></td>
            </tr>
            <tr>
                <td>Item Price: </td>
                <td><input type="text" name="item_price"></td>
            </tr>
            <tr>
                <td>Item Vendor: </td>
                <td>
                    <select name="vendor_id">
                        <?php 
                            while($row = mysqli_fetch_assoc($result_vendor)) {
                                echo "<option value=" . $row["vendor_id"] . ">" . $row["vendor_name"] . "</option>";
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td><button type="submit" name="submit">Add</button></td>
            </tr>
        </table>
    </form>
<?php include("admin_template/footer.php"); ?>