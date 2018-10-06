<?php
    require_once('$conn');
    if (isset($_POST['respond_name']) && isset($_POST['respond_content'])){
        $respond_name = $_POST['respond_name'];
        $respond_content = $_POST['respond_content'];
    }
    $sql = ""
?>