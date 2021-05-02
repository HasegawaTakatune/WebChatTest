<?php 

define('AUTH_USER', 1);
define('INST_USER', 2);
define('SLCT_ROOM', 3);

$connect = new PDO(DB_PARAM, DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false));
if(!$connect){
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'name'=>''));
}

function AuthUser(){

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    global $connect;

    if(is_null($name) || is_null($password)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.', 'name'=>''));
        return;
    }

    try{
        
        $stmt = $connect->prepare("SELECT password FROM USER WHERE name = :name ");
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

}

function InstUser(){

    $name = $_POST['name'];
    $password = $_POST['password'];
    global $connect;

    if(is_null($name) || is_null($password)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.', 'name'=>''));
        return;
    }

    try{
        $hash = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt = $connect->prepare("INSERT INTO USER (name, password, timestamp) VALUES(:name, :password, NOW()) ");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
        $stmt->execute();

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Success', 'name'=>$name));
    
    }catch(Exception $e){
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Failed to add user.', 'name'=>''));
    }
}

function SlctRoom(){

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    global $connect;

    try{

        if(is_null($name)){
            $stmt = $connect->prepare("SELECT name, type, number_of_people FROM ROOM ");
        }else{
            $stmt = $connect->prepare("SELECT name, type, number_of_people FROM ROOM WHERE name = :name ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        }        
        $stmt->execute();

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Success', 'stmt'=>$stmt));

    }catch(Exception $e){
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'stmt'=>''));
    }
}

switch($_POST['action']){
    case AUTH_USER: AuthUser(); break;
    case INST_USER: InstUser(); break;
    case SLCT_ROOM: SlctRoom(); break;
    default: break;
}