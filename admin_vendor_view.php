<?php
    if(isset($_GET['delete'])) {
        include("config/db_connect.php");
        $vdr_id = $_GET['delete'];
        $sql_vendor_delete = "DELETE FROM vendors WHERE vendor_id='$vdr_id'";
        $stmt = $conn->prepare($sql_vendor_delete);
        $stmt->execute();
        mysqli_close($conn);
    }

    $row_count = 1;
    include("config/db_connect.php");
    $sql = "SELECT * FROM  vendors";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
?>

<?php include("admin_template/header.php"); ?>

    <h2 class="title">Vendor Information</h2>

    <div class="table">
        <table>
        <tr>
            <td><h4>index</h4></td>
            <td><h4>Vendor Id</h4></td>
            <td><h4>Vendor Name</h4></td>
            <td><h4>Vendor Email</h4></td>
            <td><h4>Vendor Phone</h4></td>
            <td><h4>Vendor Address</h4></td>
            <td><h4>Vendor Status</h4></td>
            <td><h4>Actions</h4></td>
        </tr>
        <?php 
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row_count % 2 == 1) echo "<tr class='bg-lightgray'>";
                else echo "<tr>";
                echo "<td>" . $row_count++ . "</td>";
                echo "<td>" . $row["vendor_id"] . "</td>";
                echo "<td>" . $row["vendor_name"] . "</td>";
                echo "<td>" . $row["vendor_email"] . "</td>";
                echo "<td>" . $row["vendor_phone"] . "</td>";
                echo "<td>" . $row["vendor_address"] . "</td>";
                echo "<td>" . $row["vendor_status"] . "</td>";
                ?>
                <td><a href="admin_vendor_edit.php?edit=<?= $row['vendor_id'] ?>"><img class='icon' src='static/icon/edit.png'></a> 
                    <a onclick="return confirm('Do you want to remove this vendor?')" href="admin_vendor_view.php?delete=<?= $row['vendor_id'] ?>"><img class='icon' src='static/icon/eraser.png'></a></td>
                </tr>
            <?php 
            }
            } else {
                echo "0 results";
            }
        ?>
        </table>
        <a href="admin_vendor_add.php"><img class="icon" src="static/icon/plus.png" alt="">Add New Vendor</a>
    </div>

<?php include("admin_template/footer.php"); ?>