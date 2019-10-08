<?php

    $conn = mysqli_connect("localhost", "root", "", "sis");

    if(!$conn) {
        echo "Connection error " . mysqli_connect_error($conn); 
    }

?>