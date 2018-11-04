<?php
//conn
$servername = "";
$username = "";
$userpassword = "";
$dbname = "";
$conn = new mysqli($servername, $username, $userpassword, $dbname) or die("conn error");
$conn->query("SET NAMES 'UTF8'");
$conn->query("SET time_zone = '+08:00'");
//html 載入
if(isset(json_decode(file_get_contents('php://input'),true)['load'])){    
    //table
    $stmt = $conn->prepare("SELECT * FROM test WHERE id = '1'");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    echo json_encode($result);
}
//結帳按鈕
if(isset(json_decode(file_get_contents('php://input'),true)['checkout'])){
    //transaction
    $conn-> autocommit(FALSE);
    $conn->begin_transaction();
    $stmt = $conn->prepare("SELECT * FROM test WHERE id = '1' for UPDATE");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $is_success = TRUE;
    if($result['product1'] >0){
        $sql ="UPDATE test SET product1 =$result[product1]-1 WHERE id = '1'";
        $conn->query($sql);
    }
    else{
        $is_success = FALSE;
    }
    
    if($result['product2'] >0){
        $sql ="UPDATE test SET product2 =$result[product2]-1 WHERE id = '1'";
        $conn->query($sql);
    }
    else{
        $is_success = FALSE;
    }
    
    if($result['product3'] >0){
        $sql ="UPDATE test SET product3 =$result[product3]-1 WHERE id = '1'";
        $conn->query($sql);
    }
    else{
        $is_success = FALSE;
    }
    
    if($result['product4'] >0){
        $sql ="UPDATE test SET product4 =$result[product4]-1 WHERE id = '1'";
        $conn->query($sql);
    }
    else{
        $is_success = FALSE;
    }
    if($is_success){
        $conn->commit();
        echo json_encode($result);
    }
    else{
        $conn->rollback();
        $error = array("error"=>"error transaction is empty");
        echo json_encode($error);
    }
}
//廠商加碼
if(isset(json_decode(file_get_contents('php://input'),true)['all'])){
    $stmt = $conn->prepare("UPDATE test SET product1 = '3',product2 = '4' ,product3 = '5' ,product4 = '6' WHERE id = '1'");
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM test WHERE id = '1'");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    echo json_encode($result);
}
?>
