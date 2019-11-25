<?php 
    if(isset($_GET["vendor_id"])) {
        include("config/db_connect.php");
        $vendor_id = $_GET["vendor_id"];
        $vendor_name = $_GET["vendor_name"];
        $vendor_email = $_GET["vendor_email"];
        $vendor_phone = $_GET["vendor_phone"];
        $vendor_address = $_GET["vendor_address"];
        $vendor_status = "ACTIVE";
        $sql = "INSERT INTO vendors VALUES
            ('$vendor_id', '$vendor_name', '$vendor_email', '$vendor_phone', '$vendor_address', '$vendor_status')";
        if (mysqli_query($conn, $sql)) echo "New record created successfully";
        else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: admin_vendor_view.php");
    }
?>

<?php include("admin_template/header.php"); ?>

    <h2><img class='icon' src='static/icon/plus.png'>New Vendor: </h2>
    <table>
        <tr>
            <td>Vendor Id: </td>
            <td><input id="vendor_id" type="text" name="vendor_id"></td>
        </tr>
        <tr>
            <td>Vendor Name: </td>
            <td><input id="vendor_name" type="text" name="vendor_name"></td>
        </tr>
        <tr>
            <td>Vendor Email: </td>
            <td><input id="vendor_email" type="text" name="vendor_email"></td>
        </tr>
        <tr>
            <td>Vendor Phone: </td>
            <td><input id="vendor_phone" type="text" name="vendor_phone"></td>
        </tr>
        <tr>
            <td>Vendor Address: </td>
            <td><textarea id="vendor_address" name="vendor_address" id="" cols="80" rows="10"></textarea></td>
        </tr>
        <tr>
            <td><button onclick="newVendorAjax();" type="submit" name="submit">Add</button></td>
        </tr>
    </table>

    <div id="res"></div>

<?php include("admin_template/footer.php"); ?>

<script>
    function newVendorAjax() {
        vendor_id = document.getElementById("vendor_id").value;
        vendor_name = document.getElementById("vendor_name").value;
        vendor_email = document.getElementById("vendor_email").value;
        vendor_phone = document.getElementById("vendor_phone").value;
        vendor_address = document.getElementById("vendor_address").value;

        x = new XMLHttpRequest();
        x.open("GET","admin_vendor_add.php?vendor_id="+vendor_id+"&vendor_name="+vendor_name+"&vendor_email="+vendor_email+"&vendor_phone="+vendor_phone+"&vendor_address="+vendor_address, true) 
        x.send();
        x.onreadystatechange=stateChanged;
    }

    function stateChanged() { 
        if (x.readyState==4) { 
            document.getElementById("res").innerHTML = "Data inserted successfully";
        }
    }
</script>