<?php
    require_once('conn.php');
    
    if ($conn->connect_error){
        die ('error');
    };
    // print_r($conn->query("SELECT * FROM users")->fetch_assoc());
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div>' . "id: " . $row["username"] .</div>. "<br>";
        }
    } else {
        echo "0 results";
    }


?>