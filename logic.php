<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "issapfdb";

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    
    // Destroy if not possible to create a connection
    if(!$conn){
        echo "<h1>Database Connection not established<h3>";
    }

    // Get data to display on index page
    $sql = "SELECT * FROM blogs";
    $query = mysqli_query($conn, $sql);

?>