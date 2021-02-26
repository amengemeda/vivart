<?php
require ("user.php");
class Artist extends User  
{
    protected $talent;
    public function __construct($user_id,$conn=false){
        Parent::__construct($user_id,$conn);
        if ($conn!=false) {
            $sql2="SELECT talent FROM artist WHERE user_id=?";
            $array2=[$user_id];
            $result2= selectData($sql2,$conn,$array2);
            // print_r($result2);
            $this->talent=$result2["talent"];
        }
      
    }
}


?>