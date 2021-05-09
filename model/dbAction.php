<?php 

require_once('config.php');

if(empty($_POST)){
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'name'=>''));
}

$connect = new PDO(DB_PARAM, DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false));
if(!$connect){
    header('Content-type: application/json');
    echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'name'=>''));
}

function AuthUser(){

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    global $connect;

    if(empty($name) || empty($password)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.', 'name'=>''));
        return;
    }

    try{
        
        $stmt = $connect->prepare("SELECT password FROM USER WHERE name = :name ");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($row['password'])){
            header('Content-type: application/json');
            echo json_encode(array('result'=>false, 'message'=>'Non user.', 'name'=>''));
            return;
        }

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

    if(empty($name) || empty($password)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.', 'name'=>''));
        return;
    }

    try{
        $connect->beginTransaction();

        $hash = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt = $connect->prepare("INSERT INTO USER (name, password, timestamp) VALUES(:name, :password, NOW()) ");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
        $stmt->execute();
        $connect->commit();

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Successful addition of user. ', 'name'=>$name));
    
    }catch(Exception $e){
        $connect->rollBack();
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'name'=>''));
    }
}

function SlctRoom(){

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    global $connect;

    try{

        if(is_null($name)){
            $stmt = $connect->prepare("SELECT name, type FROM ROOM WHERE type != 'private' ");
        }else{
            $stmt = $connect->prepare("SELECT name, type FROM ROOM WHERE name = :name AND  type != 'private' ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        }        
        $stmt->execute();

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Successful acquisition of room.', 'rooms'=>$stmt));

    }catch(Exception $e){
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'rooms'=>''));
    }
}

function JoinKeyRoom(){
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $key = isset($_POST['key']) ? $_POST['key'] : null;
    global $connect;

    if(empty($name) || empty($key)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.', 'room'=>''));
        return;
    }

    try{

        $stmt = $connect->prepare("SELECT name FROM ROOM WHERE name = :name AND key = :key ");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':key', $hash, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($row['name'])){
            header('Content-type: application/json');
            echo json_encode(array('result'=>false, 'message'=>'Non room.', 'room'=>''));
            return;
        }

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Successful join of room.', 'room'=>$row));
    
    }catch(Exception $e){
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'room'=>''));
    }
}

function InstRoom(){
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $key = isset($_POST['key']) ? $_POST['key'] : null;
    global $connect;

    if(empty($name) || empty($type)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.', 'room'=>''));
        return;
    }

    try{
        $connect->beginTransaction();

        $stmt = $connect->prepare("INSERT INTO ROOM (name, type, key, member) VALUES(:name, :type, :key, 1) ");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':key', $key, PDO::PARAM_STR);
        $stmt->execute();
        $connect->commit();

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Successful acquisition of room.'));
    
    }catch(Exception $e){
        $connect->rollBack();
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'room'=>''));
    }
}

function AddRoomMember(){
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    global $connect;

    if(empty($name)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.'));
        return;
    }

    try{
        $connect->beginTransaction();

        $stmt = $connect->prepare("UPDATE ROOM SET member = member + 1 WHERE name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $connect->commit();

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Successful acquisition of room.'));
    }catch(Exception $e){
        $connect->rollBack();
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'room'=>''));
    }
}

function SubRoomMember(){
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    global $connect;

    if(empty($name)){
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Information is not available.'));
        return;
    }

    try{
        $connect->beginTransaction();

        $stmt = $connect->prepare("UPDATE ROOM SET member = member - 1 WHERE name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $connect->prepare("SELECT member FROM ROOM WHERE name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(0 <= $row['member']){
            $stmt = $connect->prepare("DELETE FROM ROOM WHERE name = :name");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
        }
        $connect->commit();

        header('Content-type: application/json');
        echo json_encode(array('result'=>true, 'message'=>'Successful acquisition of room.'));
    }catch(Exception $e){
        $connect->rollBack();
        var_dump($e->getmessage());
        header('Content-type: application/json');
        echo json_encode(array('result'=>false, 'message'=>'Connection failed.', 'room'=>''));
    }
}

switch($_POST['action']){
    case AUTH_USER: AuthUser(); break;
    case INST_USER: InstUser(); break;
    case SLCT_ROOM: SlctRoom(); break;
    case JOIN_KEY_ROOM: JoinKeyRoom(); break;
    case INST_ROOM: InstRoom(); break;
    case ADD_ROOM_MEMBER: AddRoomMember(); break;
    case SUB_ROOM_MEMBER: SubRoomMember(); break;
    default: break;
}

$connect = null;