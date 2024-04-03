<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "Ak200222!";
$dbname = "php_db";
@ $db = mysqli_connect($dbservername, $dbusername, $dbpassword);
mysqli_select_db($db, $dbname) or die(mysqli_error());

if (!$db) {
    echo "Error: could not connect to database. Please try again later";
}

?>