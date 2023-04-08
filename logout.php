<?php
session_start();
session_destroy();
header('Location: /issablog/index.php');
exit;
?>