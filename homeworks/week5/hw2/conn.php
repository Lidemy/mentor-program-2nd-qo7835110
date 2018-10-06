<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'mentor';
$conn = new mysqli($servername, $username, $password, $dbname) or die ("連接錯誤<br/>");
$conn->query("SET NAMES 'UTF8'");
$conn->query("SET time_zone = '+08:00'");
?>