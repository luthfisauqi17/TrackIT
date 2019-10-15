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

    if(isset($_POST["submit"])) {
        include("config/db_connect.php");
        $vendor_id = $_POST["vendor_id"];
        $vendor_name = $_POST["vendor_name"];
        $vendor_email = $_POST["vendor_email"];
        $vendor_phone = $_POST["vendor_phone"];
        $vendor_address = $_POST["vendor_address"];
        $vendor_status = $_POST["vendor_status"];

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
    <form action="admin_vendor_edit.php" method="POST">
        <h2><img class='icon' src='static/icon/edit.png'>Edit Vendor: </h2>
        <input type="hidden" name="vendor_id" value="<?= $id ?>">
        <table>
            <tr>
                <td>Vendor Name: </td>
                <td><input type="text" name="vendor_name" value="<?= $name ?>"></td>
            </tr>
            <tr>
                <td>Vendor Email: </td>
                <td><input type="text" name="vendor_email" value="<?= $email ?>"></td>
            </tr>
            <tr>
                <td>Vendor Phone: </td>
                <td><input type="text" name="vendor_phone" value="<?= $phone ?>"></td>
            </tr>
            <tr>
                <td>Vendor Address: </td>
                <td><textarea name="vendor_address" id="" cols="80" rows="10"><?= $addrs ?></textarea></td>
            </tr>
            <tr>
                <td>Vendor Status</td>
                <td>
                    <input type="radio" name="vendor_status" value="ACTIVE" checked>ACTIVE
                    <input type="radio" name="vendor_status" value="NOT ACTIVE">NOT ACTIVE
                </td>
            </tr>
            <tr>
                <td><button type="submit" name="submit">Add</button></td>
            </tr>
        </table>
    </form>
<?php include("admin_template/footer.php"); ?>