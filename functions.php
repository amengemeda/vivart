<?php

function selectData($sql,$conn,$array){
    try {
        $stmt=$conn->prepare($sql);
        $stmt->execute($array);
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmt->fetch();       
        $stmt=null;
        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function insertData($sql,$conn,$array){
    try {
        $stmt=$conn->prepare($sql);
        $stmt->execute($array);
        $stmt=null;
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
function checkEmail($conn,$email){
    $sql="SELECT user_id FROM user WHERE email=?";
    $array=[$email];
    $result=selectData($sql,$conn,$array);
    if($result!=null){
        return true;
    }else {
        return false;   
    }

}

?>