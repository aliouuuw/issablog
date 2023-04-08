<?php

include "logic.php";
$current_page = $_SERVER['REQUEST_URI'];


$errors = array();

$username = "";
$password = "";

if (isset($_POST['login-btn'])){

    //username and password validation
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        // username is empty
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Username is required');

    } else if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
        // username contains invalid characters
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Username is not valid');

    } 

    if (empty($password)) {
        // password is empty
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Password is required');

    } else if (strlen($password) < 8) {
        // password is too short
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Password is too short');
    }
        
    // proceed with the login process if no error is found
    if (count($errors) === 0) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);
        if ($result->num_rows == 1) {
            // username and password are correct
            // set session variables and redirect to admin panel
            $_SESSION['username'] = $username;
            $_SESSION['admin'] = 1;
            header('Location: /issablog/admin.php');
            exit;
        } else {
            // username and password are incorrect
            // handle error here, e.g. display an error message to the user
            array_push($errors, 'Access Denied!');
        }
    
    } else {
        $username = $_POST['username'];
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Italianno&display=swap&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="index.css">
    <title>IssaBlog</title>
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
                        echo 'class="current"'; ?>><a href="./">Home</a></li>

                    <?php if(isset($_SESSION['username'])): ?>
                        <li style="margin-right:30px" <?php if ($current_page == '/issablog/about.php')
                            echo 'class="current"'; ?>><a href="about.php">About Me</a></li>
                        <li style="margin-right:30px" <?php if ($current_page == '/issablog/admin.php')
                            echo 'class="current"'; ?>><a href="admin.php">Admin</a></li>
                        <li class="loginbtn"><form class="logout" method="post" action="logout.php"><button type="submit" value="Logout">Logout</button></form></li>

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
        <section class="abtsec">
            <?php if(count($errors) > 0): ?>
                <div class="errors">
                   <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                   <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <h1>Admin login</h1>
                <div class="formin">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?php echo $username?>">
                </div>
                <div class="formin">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>
                <section>
                    <button type="submit" name="login-btn">Login</button>
                </section>
            </form>
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