<?php 

    $id = '';
    $name = '';
    $email = '';
    $phone = '';
    $addrs = '';
    $status = '';

    if(isset($_GET['edit'])) {
        include("config/db_connect.php");
        $vdr_edit_id = $_GET['edit'];
        $sql_edit = "SELECT * FROM vendors WHERE vendor_id='$vdr_edit_id'";
        $result_edit = mysqli_query($conn, $sql_edit);
        $row_edit = $result_edit->fetch_assoc();
        $id = $vdr_edit_id;
        $name = $row_edit["vendor_name"];
        $email = $row_edit["vendor_email"];
        $phone = $row_edit["vendor_phone"];
        $addrs = $row_edit["vendor_address"];
        $status = $row_edit["vendor_status"];
    }

    if(isset($_GET["vendor_id"])) {
        include("config/db_connect.php");
        $vendor_id = $_GET["vendor_id"];
        $vendor_name = $_GET["vendor_name"];
        $vendor_email = $_GET["vendor_email"];
        $vendor_phone = $_GET["vendor_phone"];
        $vendor_address = $_GET["vendor_address"];
        $vendor_status = $_GET["vendor_status"];

        $sql_update =  
                    "UPDATE vendors 
                    SET vendor_name='$vendor_name', vendor_email='$vendor_email', vendor_phone='$vendor_phone', vendor_address='$vendor_address', vendor_status='$vendor_status' 
                    WHERE vendor_id='$vendor_id'";
        
        if (mysqli_query($conn, $sql_update)) echo "New record updated successfully";
        else echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_vendor_view.php");
    }
?>

<?php include("admin_template/header.php"); ?>

    <h2><img class='icon' src='static/icon/edit.png'>Edit Vendor: </h2>
    <input id="vendor_id" type="hidden" name="vendor_id" value="<?= $id ?>">
    <table>
        <tr>
            <td>Vendor Name: </td>
            <td><input id="vendor_name" type="text" name="vendor_name" value="<?= $name ?>"></td>
        </tr>
        <tr>
            <td>Vendor Email: </td>
            <td><input id="vendor_email" type="text" name="vendor_email" value="<?= $email ?>"></td>
        </tr>
        <tr>
            <td>Vendor Phone: </td>
            <td><input id="vendor_phone" type="text" name="vendor_phone" value="<?= $phone ?>"></td>
        </tr>
        <tr>
            <td>Vendor Address: </td>
            <td><textarea id="vendor_address" name="vendor_address" id="" cols="80" rows="10"><?= $addrs ?></textarea></td>
        </tr>
        <tr>
            <td>Vendor Status</td>
            <td>
                <input id="active_rb" type="radio" name="vendor_status" value="ACTIVE" checked>ACTIVE
                <input id="not_active_rb" type="radio" name="vendor_status" value="NOT ACTIVE">NOT ACTIVE
            </td>
        </tr>
        <tr>
            <td><button onclick="editVendorAjax();" type="submit" name="submit">Add</button></td>
        </tr>
    </table>

    <div id="res"></div>
        
<?php include("admin_template/footer.php"); ?>

<script>
    function editVendorAjax() {
        vendor_id = document.getElementById("vendor_id").value;
        vendor_name = document.getElementById("vendor_name").value;
        vendor_email = document.getElementById("vendor_email").value;
        vendor_phone = document.getElementById("vendor_phone").value;
        vendor_address = document.getElementById("vendor_address").value;
        if(document.getElementById("active_rb").checked) {
            vendor_status = document.getElementById("active_rb").value;
        }
        else if(document.getElementById("not_active_rb").checked) {
            vendor_status = document.getElementById("not_active_rb").value;
        }


        x = new XMLHttpRequest();
        x.open("GET","admin_vendor_edit.php?vendor_id="+vendor_id+"&vendor_name="+vendor_name+"&vendor_email="+vendor_email+"&vendor_phone="+vendor_phone+"&vendor_address="+vendor_address+"&vendor_status="+vendor_status, true) 
        x.send();
        x.onreadystatechange=stateChanged;
    }

    function stateChanged() { 
        if (x.readyState==4) { 
            document.getElementById("res").innerHTML = "Data updated successfully";
        }
    }
</script>