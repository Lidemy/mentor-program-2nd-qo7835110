<?php
$servername = '166.62.28.131';
$username = 'student2nd';
$password = 'mentorstudent123';
$dbname = 'mentor_program_db';
$conn = new mysqli($servername, $username, $password, $dbname) or die ("連接錯誤<br/>");
$conn->query("SET NAMES 'UTF8'");
$conn->query("SET time_zone = '+08:00'");
?>