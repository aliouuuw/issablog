<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "issapfdb";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);


// Destroy if not possible to create a connection
if (!$conn) {
    echo "<h1>Database Connection not established<h3>";
}

// Get data to display on index page
$sql = "SELECT * FROM blogs";
$query = mysqli_query($conn, $sql);

// Create a new post
if(isset($_POST['add_post'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO blogs(title, content) VALUES('$title', '$content')";
    mysqli_query($conn, $sql);

    echo $sql;

    header("Location: issablog/admin.php");
    exit();
}


?>