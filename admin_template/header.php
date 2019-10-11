<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-Panel</title>
    <link rel="stylesheet" href="admin_template/styles.css">
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <h1>Store Information System</h1>
        </div>
        <div class="navbar-right">
            <ul>
                <!-- <li><a href="#"><div><img class="icon" src="static/icon/logout.png" alt="">Logout</div></a></li> -->
            </ul>
        </div>
    </div>

    <div class="display">
        <div class="sidebar">
            <ul>
                <li><a href="admin_inv_view.php"><div><img class="icon" src="static/icon/inventory.png">Inventory</div></a></li>
                <li><a href="admin_vendor_view.php"><div><img class="icon" src="static/icon/vendor.png">Vendor Information</div></a></li>
                <li><a href="admin_trans_view.php"><div><img class="icon" src="static/icon/transaction.png">Transaction History</div></a></li>
                <li><a href="#"><div><img class="icon" src="static/icon/pie-chart.png">Statistics</div></a></li>
            </ul>
        </div>
        <div class="content">
