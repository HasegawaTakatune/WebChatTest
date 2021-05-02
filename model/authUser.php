<?php

$name = isset($_POST['name']) ? $_POST['name'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if(is_null($name) || is_null($password)){
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'message'=>'Information is not available.', 'name'=>''));    
}

try{
    $db = new PDO(DB_PARAM, DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false));
    
    $stmt = $db->prepare("SELECT password FROM USER WHERE name = :name");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-type: application/json');
    if(password_verify($password, $row['password'])) 
        echo json_encode(array('result'=>true, 'message'=>'Authentication was successful.', 'name'=>$name));
    else 
        echo json_encode(array('result'=>false, 'message'=>'Authentication was failed.', 'name'=>''));
    
}catch(Exception $e){
    var_dump($e->getmessage());
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'name'=>''));
}

?>