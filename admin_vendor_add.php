<?php 
    if(isset($_POST["submit"])) {
        include("config/db_connect.php");
        $vendor_id = $_POST["vendor_id"];
        $vendor_name = $_POST["vendor_name"];
        $vendor_email = $_POST["vendor_email"];
        $vendor_phone = $_POST["vendor_phone"];
        $vendor_address = $_POST["vendor_address"];
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
    <form action="admin_vendor_add.php" method="POST">
        <h2><img class='icon' src='static/icon/plus.png'>New Vendor: </h2>
        <table>
            <tr>
                <td>Vendor Id: </td>
                <td><input type="text" name="vendor_id"></td>
            </tr>
            <tr>
                <td>Vendor Name: </td>
                <td><input type="text" name="vendor_name"></td>
            </tr>
            <tr>
                <td>Vendor Email: </td>
                <td><input type="text" name="vendor_email"></td>
            </tr>
            <tr>
                <td>Vendor Phone: </td>
                <td><input type="text" name="vendor_phone"></td>
            </tr>
            <tr>
                <td>Vendor Address: </td>
                <td><textarea name="vendor_address" id="" cols="80" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><button type="submit" name="submit">Add</button></td>
            </tr>
        </table>
    </form>
<?php include("admin_template/footer.php"); ?>