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
function selectAllData($sql,$conn,$array){
    try {
        $stmt=$conn->prepare($sql);
        $stmt->execute($array);
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result=$stmt->fetchAll();       
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
function is_image($path)
{
	$a = getimagesize($path);
    $image_type;
    if(isset($a[2])){
        $image_type = $a[2];
    }else {
        return false;
    }
	
	
	if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
	{
		return true;
	}
	return false;
}

function get_craft_type($a)
{
    if($a == "video"){
        return "Video";
    }else if($a == "audio"){
        return "Audio";
    }else if($a == "image"){
        return "Image";
    }else
    {
        return "Decline";
    }
}


?>