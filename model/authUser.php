<?php

$name = $_POST['name'];
$password = $_POST['password'];

try{
    $db = new PDO(DB_PARAM, DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false));
    
    $stmt = $db->prepare("SELECT password FROM USER WHERE name = :name");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-type: application/json');
    if(password_verify($password, $row['password'])) 
        echo json_encode(array('result'=>true, 'name'=>$name));
    else 
        echo json_encode(array('result'=>false, 'name'=>''));
    
}catch(Exception $e){
    var_dump($e->getmessage());
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'name'=>''));
}

?>