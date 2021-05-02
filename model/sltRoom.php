<?php

$name = isset($_POST['name']) ? $_POST['name'] : null;

try{

    $db = new PDO(DB_PARAM, DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false));
    $stmt = $db->prepare("SELECT name, type, number_of_people FROM ROOM");
    $stmt->execute();

}catch(Exception $e){
    var_dump($e->getmessage());
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'name'=>''));
}

?>