<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "good";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET CHARACTER SET utf8");
?>
