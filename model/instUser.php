<?php

$name = $_POST['name'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

try{
    $db = new PDO(DB_PARAM, DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false));
    
    $stmt = $db->prepare("INSERT INTO USER (name, password, timestamp) VALUES(:name, :password, NOW())");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
    $stmt->execute();

    header('Content-type: application/json');
    echo json_encode(array('result'=>true, 'name'=>$name));
    
}catch(Exception $e){
    var_dump($e->getmessage());
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'name'=>''));
}

?>