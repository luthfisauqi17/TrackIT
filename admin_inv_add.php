<?php 
    if(isset($_GET["item_id"])) {
        include("config/db_connect.php");
        $item_id = $_GET["item_id"];
        $item_name = $_GET["item_name"];
        $item_remain = $_GET["item_remain"];
        $item_price = $_GET["item_price"];
        $item_sold = 0;
        $item_status = "ACTIVE";
        $vendor_id = $_GET["vendor_id"];
        $user_name = $_GET["user_name"];

        $sql = "INSERT INTO items VALUES('$item_id', '$item_name', '$item_remain', '$item_price', '$item_sold', '$item_status', '$vendor_id', '$user_name')";
        
        if (mysqli_query($conn, $sql)) echo "New record created successfully";
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_inv_view.php");
    }

    include("config/db_connect.php");
    $sql_vendor = "SELECT * FROM vendors";
    $result_vendor = mysqli_query($conn, $sql_vendor);


    $sql_user = "SELECT * FROM users";
    $result_user = mysqli_query($conn, $sql_user);
    mysqli_close($conn);

?>

 <?php include("admin_template/header.php"); ?> 

    <h2><img class='icon' src='static/icon/plus.png'>New Item: </h2>
    <table>
        <tr>
            <td>Item Id: </td>
            <td><input id = "item_id" type="text" name="item_id"></td>
        </tr>
        <tr>
            <td>Item Name: </td>
            <td><input id = "item_name" class="input-medium" type="text" name="item_name"></td>
        </tr>
        <tr>
            <td>Item Quantity: </td>
            <td><input id = "item_qty" type="text" name="item_remain"></td>
        </tr>
        <tr>
            <td>Item Price: </td>
            <td><input id = "item_price" type="text" name="item_price"></td>
        </tr>
        <tr>
            <td>Item Vendor: </td>
            <td>
                <select id = "item_vendor" name="vendor_id">
                    <?php 
                        while($row = mysqli_fetch_assoc($result_vendor)) {
                            echo "<option value=" . $row["vendor_id"] . ">" . $row["vendor_name"] . "</option>";
                        }
                    ?>
            </td>
        </tr>
        <tr>
            <td>Item Owner: </td>
            <td>
                <select id = "item_owner" name="user_name">
                    <?php 
                        while($row = mysqli_fetch_assoc($result_user)) {
                            echo "<option value=" . $row["user_name"] . ">" . $row["user_name"] . "</option>";
                        }
                    ?>
            </td>
        </tr>
        <tr>
            <td><button onclick="newInvAjax();" type="submit" name="submit">Add</button></td>
        </tr>
    </table>

    <div id="res"></div>

<?php include("admin_template/footer.php"); ?>

<script>
    function newInvAjax() {
        item_id = document.getElementById("item_id").value;
        item_name = document.getElementById("item_name").value;
        item_qty = document.getElementById("item_qty").value;
        item_price = document.getElementById("item_price").value;
        item_vendor = document.getElementById("item_vendor").value;
        item_owner = document.getElementById("item_owner").value;

        x = new XMLHttpRequest();
        x.open("GET","admin_inv_add.php?item_id="+item_id+"&item_name="+item_name+"&item_remain="+item_qty+"&item_price="+item_price+"&vendor_id="+item_vendor+"&user_name="+item_owner, true) 
        x.send();
        x.onreadystatechange=stateChanged;
    }

    function stateChanged() { 
        if (x.readyState==4) { 
            document.getElementById("res").innerHTML = "Data inserted successfully";
        }
    }
</script>