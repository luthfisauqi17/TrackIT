<?php 

$first = true;
$item_name = array();

include("config/db_connect.php");
$sql_sold_items = "SELECT * FROM items";
$result_sold_items = mysqli_query($conn, $sql_sold_items);
$result_item_name = mysqli_query($conn, $sql_sold_items);
mysqli_close($conn);

while($item = mysqli_fetch_assoc($result_item_name)) {
    array_push($item_name, $item["item_name"]);
}
?>

<?php include("admin_template/header.php"); ?>

<h2 class="title">Items Sold Chart</h2>

<input value="<?php
while($row = mysqli_fetch_assoc($result_sold_items)) {
    if($first == true) {
        echo $row["item_sold"] * 200;
        $first = false;
    }
    else {
        echo "," . $row["item_sold"] * 200;
    }
}
?>" type="hidden" name="number" id="num"><br>

<canvas id="myCanvas" width="900" height="500" style="margin-left: 10%; border-bottom:1px solid black;"></canvas>

<script>
    function draw() {
        /* Accepting and seperating comma seperated values */
        var n = document.getElementById("num").value;
        var values = n.split(',');

        var item_name_arr = <?php echo json_encode($item_name);?>;
         
        var canvas = document.getElementById('myCanvas');
        var ctx = canvas.getContext('2d');
 
        var width = 40; //bar width
        var X = 50; // first bar position 
        var base = 200;
         
        for (var i =0; i<values.length; i++) {
            ctx.fillStyle = '#008080'; 
            var h = values[i];
            ctx.fillRect(X,canvas.height - h,width,h);
             
            X +=  width+15;
            /* text to display Bar number */
            ctx.fillStyle = '#4da6ff';
            ctx.fillText(item_name_arr[i],X-50,canvas.height - h -10);
        }
            /* Text to display scale */
            ctx.fillStyle = '#000000';
            ctx.fillText('Scale X : ' +canvas.width+' Y : '+canvas.height,800,10);
   
    }
</script>

<?php include("admin_template/footer.php"); ?>