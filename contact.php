<?php

include "logic.php";
$current_page = $_SERVER['REQUEST_URI'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$errors = array();

$email = "";
$subject = "";
$message = "";

if (isset($_POST['send-mail'])) {

    //email and subject validation
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];



    if (empty($email)) {
        // email is empty
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Email is required');

    }
    if (empty($subject)) {
        // subject is empty
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Subject is required');

    }

    if (empty($message)) {
        // message is empty
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Message is required');

    } else if (strlen($message) < 15) {
        // message is too short
        // handle error here, e.g. display an error message to the user
        array_push($errors, 'Please enter more than 15 characters');
    }

    // proceed with the login process if no error is found
    if (count($errors) === 0) {

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Server settings

        $mail->isSMTP();                                 //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                //Set the SMTP server to send through
        $mail->SMTPAuth = true;                          //Enable SMTP authentication
        $mail->Username = 'wadealiou00@gmail.com';       //Your email
        $mail->Password = 'ocplcdfrkvlfovof';            //Your gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465;                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom($email);
        $mail->addAddress('wadealiou00@gmail.com');

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        echo "<script> alert('Sent Succesfully!');; window.location.href='/issablog/contact.php';</script>";
        exit;

    } else {
        array_push($errors, 'Error Occured!');
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
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
                        echo 'class="current"'; ?>><a href="./">Home</a>
                    </li>

                    <?php if (isset($_SESSION['email'])): ?>
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
        <section class="abtsec">
            <?php if (count($errors) > 0): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p>
                            <?php echo $error; ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="contact.php" method="post">
                <h1>Love to hear from you!</h1>
                <div class="formin">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $email ?>">
                </div>
                <div class="formin">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" value="<?php echo $subject ?>">
                </div>
                <div class="formin">
                    <label for="message">Message:</label>
                    <textarea name="message"><?php echo $message ?></textarea>
                </div>
                <section>
                    <button type="submit" name="send-mail">Send</button>
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