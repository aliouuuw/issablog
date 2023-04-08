<?php

include "logic.php";
$current_page = $_SERVER['REQUEST_URI'];

// Check if user is logged in as admin
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: /issablog/admin.php');
    exit;
}

// Display admin panel here
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Italianno&display=swap&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="index.css">
    <title>IssaBlog Admin</title>
</head>

<body>
    <header>
        <div>
            <h2>Issa lambert</h5>
        </div>
        <nav>
            <div>
                <ul>
                    <li <?php if ($current_page == '/issablog/index.php')
                        echo 'class="current"'; ?>><a href="./">Home</a>
                    </li>

                    <?php if (isset($_SESSION['username'])): ?>
                        <li style="margin-right:30px" <?php if ($current_page == '/issablog/about.php')
                            echo 'class="current"'; ?>><a href="about.php">About Me</a></li>
                        <li style="margin-right:30px" <?php if ($current_page == '/issablog/admin.php')
                            echo 'class="current"'; ?>><a href="admin.php">Admin</a></li>
                        <li class="loginbtn">
                            <form class="logout" method="post" action="logout.php"><button type="submit"
                                    value="Logout">Logout</button></form>
                        </li>

                    <?php else: ?>
                        <li style="margin-right:30px" <?php if ($current_page == '/issablog/about.php')
                            echo 'class="current"'; ?>><a href="about.php">About Me</a></li>
                        <li style="margin-right:30px" <?php if ($current_page == '/issablog/contact.php')
                            echo 'class="current"'; ?>><a href="contact.php">Contact Me</a></li>
                        <li class="loginbtn"><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h1>Welcome,
            <?php echo $_SESSION['username']; ?>!
        </h1>
        <section class="adblogsec">
            <div class='adblogtitle'>
                <h1>My Blog Posts</h1>
                <button onclick="document.getElementById('add-blog-modal').style.display='block'">Add New Post</button>
            </div>

            <?php foreach ($query as $q) { ?>
                <div class="adblogitem">
                    <span class='blogdate'>
                        <?php echo $q['date']; ?>
                    </span>
                    <div class="adblogcontent">
                        <p>
                            <?php echo $q['title']; ?>
                        </p>
                        <div>
                            <button class="updatebtn"
                                onclick="document.getElementById('update-blog-modal-<?php echo $q['id']; ?>').style.display='block'">Edit</button>
                            <button class="deletebtn"
                                onclick="document.getElementById('delete-blog-modal-<?php echo $q['id']; ?>').style.display='block'">Delete</button>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="addmodal" id="add-blog-modal">
                <form class="modal-content" action="admin.php" method="post">
                    <span onclick="document.getElementById('add-blog-modal').style.display='none'" class="close"
                        title="Close Modal">X</span>
                    <h1>Add New Post</h1>
                    <label for="title"><b>Title</b></label>
                    <input type="text" placeholder="Enter Title" name="title" required>

                    <label for="content"><b>Content</b></label>
                    <textarea placeholder="Enter Content" name="content" required></textarea>

                    <button type="submit" name="add_post">Add Post</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <ul>
            <li class="ctbtn"><a href="https://www.instagram.com/issaa_lambert/" style="color: #FFFFFF">Instagram</a>
            </li>
            <li class="ctbtn"><a href="https://twitter.com/LambertIssa" style="color: #FFFFFF">Twitter</a></li>
            <li class="ctbtn"><a href="" style="color: #FFFFFF">Github</a></li>
        </ul>
    </footer>
</body>

</html>