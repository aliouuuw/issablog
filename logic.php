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

// Get blog data to display on index page
$sql = "SELECT * FROM blogs";
$query = mysqli_query($conn, $sql);

// Create a new post
if(isset($_POST['add_post'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO blogs(title, content) VALUES('$title', '$content')";
    mysqli_query($conn, $sql);

    echo $sql;

    header("Location: /issablog/admin.php");
    exit();
}

// Update a post
if(isset($_POST['update_post'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE blogs SET title =  IF('$title'='', title, '$title'), content =  IF('$content'='', content, '$content') WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: /issablog/admin.php");
    exit();
}

// Delete a post
if(isset($_POST['delete_post'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM blogs WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: /issablog/admin.php");
    exit();
}


// Get data to display on index page
$sql2 = "SELECT * FROM tools";
$query2 = mysqli_query($conn, $sql2);


// Create a new tool
if(isset($_POST['add_tool'])){
    $imageurl = $_FILES['imageurl']['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO tools(imageurl, title, content) VALUES('$imageurl', '$title', '$content')";
    $res  = mysqli_query($conn, $sql);

    if ($res){
        move_uploaded_file($_FILES['imageurl']['tmp_name'], "$imageurl");
    }

    header("Location: /issablog/admin.php");
    exit();
}

// Update a tool
if(isset($_POST['update_tool'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $imageurl = $_POST['imageurl'];
    $content = $_POST['content'];

    $sql = "UPDATE tools SET title =  IF('$title'='', title, '$title'), content =  IF('$content'='', content, '$content'), imageurl =  IF('$imageurl'='', imageurl, '$imageurl') WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: /issablog/admin.php");
    exit();
}

// Delete a post
if(isset($_POST['delete_tool'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM tools WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: /issablog/admin.php");
    exit();
}

?>