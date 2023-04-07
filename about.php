<?php

include "logic.php";
$current_page = $_SERVER['REQUEST_URI'];

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
                    <li <?php if ($current_page == '/issablog/')
                        echo 'class="current"'; ?>><a href="./">Home</a></li>
                    <li style="margin-right:30px" <?php if ($current_page == '/issablog/about.php')
                        echo 'class="current"'; ?>><a href="about.php">About Me</a></li>
                    <li class="ctbtn"><a href="contact.php" style="color: #FFFFFF">Contact Me</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="abtsec">
            <div class="abtcontainer">
                <p class="abtext">As a Computer Science student, I am constantly exploring new technologies and programming languages to expand my knowledge and skills. I'm also a digital creator who is passionate about capturing the world around me through videography and photography. When I'm not behind the camera or computer, you'll likely find me gaming or tinkering with the latest tech gadgets. I'm a self-proclaimed car addict, with a deep love for all things automotive, and my modeling experience rounds out my versatile skillset.</p>
            </div>
        </section>

        <section class='blogsec'>
            <div class='blogtitle'>
                <h1>My Toolbox</h1>
            </div>

        </section>
    </main>
    <footer>
        <ul>
            <li class="ctbtn"><a href="https://www.instagram.com/issaa_lambert/" style="color: #FFFFFF">Instagram</a></li>
            <li class="ctbtn"><a href="https://twitter.com/LambertIssa" style="color: #FFFFFF">Twitter</a></li>
            <li class="ctbtn"><a href="" style="color: #FFFFFF">Github</a></li>
        </ul>
    </footer>
</body>

</html>