<?php 

    $id = '';
    $name = '';
    $qty = 0;
    $prc = 0;

    if(isset($_GET['edit'])) {
        include("config/db_connect.php");
        $itm_edit_id = $_GET['edit'];
        $sql_edit = "SELECT * FROM items WHERE item_id='$itm_edit_id'";
        $result_edit = mysqli_query($conn, $sql_edit);
        $row_edit = $result_edit->fetch_assoc();
        $id = $itm_edit_id;
        $name = $row_edit["item_name"];
        $qty = $row_edit["item_remain"];
        $prc = $row_edit["item_price"];
    }

    if(isset($_GET["item_id"])) {
        include("config/db_connect.php");
        $item_id = $_GET["item_id"];
        $item_name = $_GET["item_name"];
        $item_remain = $_GET["item_remain"];
        $item_price = $_GET["item_price"];
        $item_status = $_GET["item_status"];

        $sql_update =  
                    "UPDATE items 
                    SET item_name='$item_name', item_remain='$item_remain', item_price='$item_price', item_status='$item_status' 
                    WHERE item_id='$item_id'";
        
        if (mysqli_query($conn, $sql_update)) echo "New record updated successfully";
        else echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_inv_view.php");
    }

    include("config/db_connect.php");
    $sql_vendor = "SELECT * FROM vendors";
    $result_vendor = mysqli_query($conn, $sql_vendor);
    mysqli_close($conn);

?>

<?php include("admin_template/header.php"); ?>
    <h2><img class='icon' src='static/icon/edit.png'>Edit Item: </h2>
    <input id="item_id" type="hidden" name="item_id" value="<?= $id ?>">
    <table>
        <tr>
            <td>Item Name: </td>
            <td><input id="item_name" type="text" name="item_name" value="<?= $name ?>"></td>
        </tr>
        <tr>
            <td>Item Quantity: </td>
            <td><input id="item_remain" type="text" name="item_remain" value="<?= $qty ?>"></td>
        </tr>
        <tr>
            <td>Item Price: </td>
            <td><input id="item_price" type="text" name="item_price" value="<?= $prc ?>"></td>
        </tr>
        <tr>
            <td>Item Status</td>
            <td>
                <input id="active_rb" type="radio" name="item_status" value="ACTIVE" checked>ACTIVE
                <input id="not_active_rb" type="radio" name="item_status" value="NOT ACTIVE">NOT ACTIVE
            </td>
        </tr>
        <tr>
            <td><button onclick="editInvAjax();" type="submit" name="submit">Add</button></td>
        </tr>
    </table>

    <div id="res"></div>

<?php include("admin_template/footer.php"); ?>

<script>
    function editInvAjax() {
        item_id = document.getElementById("item_id").value;
        item_name = document.getElementById("item_name").value;
        item_remain = document.getElementById("item_remain").value;
        item_price = document.getElementById("item_price").value;
        if(document.getElementById("active_rb").checked) {
            item_status = document.getElementById("active_rb").value;
        }
        else if(document.getElementById("not_active_rb").checked) {
            item_status = document.getElementById("not_active_rb").value;
        }

        x = new XMLHttpRequest();
        x.open("GET","admin_inv_edit.php?item_id="+item_id+"&item_name="+item_name+"&item_remain="+item_remain+"&item_price="+item_price+"&item_status="+item_status, true) 
        x.send();
        x.onreadystatechange=stateChanged;
    }

    function stateChanged() { 
        if (x.readyState==4) { 
            document.getElementById("res").innerHTML = "Data updated successfully";
        }
    }
</script>