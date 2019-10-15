<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-Panel</title>
    <link rel="shortcut icon" href="static/icon/track.png" type="image/x-icon">
    <link rel="stylesheet" href="client_template/styles.css">
</head>
<body onload="draw()">
    <div class="navbar">
        <div class="navbar-left">
            <a href="client_inv_view.php"><img class="main-icon" src="static/icon/track.png" alt="icon"><h1>TrackIT</h1><p>admin</p></a>
        </div>
        <div class="navbar-right">
            <ul>
                <li><a href="index.html"><img class="icon" src="static/icon/logout.png" alt=""><p>Logout</p></a></li>
            </ul>
        </div>
    </div>

    <div class="display">
        <div class="sidebar">
            <ul>
                <li><a href="admin_owner_view.php"><div><img class="icon" src="static/icon/new_owner.png" alt="">Owners</div></a></li>
                <li><a href="admin_inv_view.php"><div><img class="icon" src="static/icon/inventory.png">Inventory</div></a></li>
                <li><a href="admin_vendor_view.php"><div><img class="icon" src="static/icon/vendor.png">Vendor Information</div></a></li>
                <li><a href="admin_trans_view.php"><div><img class="icon" src="static/icon/transaction.png">Transaction History</div></a></li>
                <li><a href="admin_statistic_view.php"><div><img class="icon" src="static/icon/pie-chart.png">Statistics</div></a></li>
            </ul>
        </div>
        <div class="content">
