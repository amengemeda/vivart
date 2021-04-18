<?php
require ("user.php");
class Recruiter extends User  
{
    //protected $talent;
    public function __construct($user_id=false,$conn=false){
        Parent::__construct($user_id,$conn);
        if ($conn!=false && $user_id!=false) {
            $sql2="SELECT talent FROM artist WHERE user_id=?";
            $array2=[$user_id];
            $result2= selectData($sql2,$conn,$array2);
            // print_r($result2);
            if ($result2!=null) {
                $this->talent=$result2["talent"];
            }
            
        }
      
    }
    public function updateProfile($conn,$profile_photo,$id){
        try {
            $sql="UPDATE user SET first_name=?,last_name=?,email=?,description=? WHERE user_id=?";
            $array=array($this->first_name,$this->last_name,$this->email,$this->description,$id);
            insertData($sql,$conn,$array);         
            $sql2="SELECT profile_photo FROM user WHERE user_id=?";
            $array2=array($id);
            $result=selectData($sql2,$conn,$array2);
            $profile_photo_upload_path=$result['profile_photo'];
            if ($profile_photo!=null) {
                if (!empty($profile_photo_upload_path)) {
                    $upload_path="../".$profile_photo_upload_path;
                    move_uploaded_file($profile_photo['tmp_name'],$upload_path);
                }else {
                    $imageFileType = strtolower(pathinfo($profile_photo['name'],PATHINFO_EXTENSION));
                    $profile_photo_upload_path="Image/profile".$id.".".$imageFileType;
                    $sql3="UPDATE user SET profile_photo=? WHERE user_id=?";
                    $array3=array($profile_photo_upload_path,$id);
                    insertData($sql3,$conn,$array3);
                    $upload_path="../".$profile_photo_upload_path;
                    move_uploaded_file($profile_photo['tmp_name'],$upload_path);
                }
               
            }
            echo "Successful";
        }catch (Exception  $th) {
            throw $th;
        }

    }

    public function addGig($conn, $gig_name, $gig_description, $gig_file){
        try{
            $sql = "SELECT MAX(gig_id) as last_Id FROM gig";
            $array = array();
            $result = selectData($sql, $conn, $array);
            $imageFileType = strtolower(pathinfo($gig_file['name'],PATHINFO_EXTENSION));
            $array = explode( "/", $gig_file['type']);
            $gig_folder = get_content_type($array[0]);
            if($gig_folder == "Decline"){
                echo "Ensure your upload is an image/video/audio";
            }else{
                $gig_upload_path = $gig_folder."/gig".$this->user_id.$result['last_Id'].".".$imageFileType;
                $sql = "INSERT INTO gig (user_id,gig_name,gig_description,gig_upload_path) VALUES(?,?,?,?)";
                $array = array($this->user_id,$gig_name,$gig_description,$gig_upload_path); 
                insertData($sql,$conn,$array);
                $upload_path="../".$gig_upload_path;
                move_uploaded_file($gig_file['tmp_name'],$upload_path);
                echo "Successful";
            } 
            
        }catch(Exception $e){
            throw $e;            
        }
    }

    public function getGigsUploaded($conn){
       $sql="SELECT gig_id,gig_name,gig_description,gig_upload_path FROM gig WHERE user_id=?";
       $array=array($this->user_id);
       $result=selectAllData($sql,$conn,$array);
       return $result; 
   }
   public function approveGigApplication($conn,$applicantId,$gigId){
    $sql="UPDATE gig_application SET status=? WHERE user_id=? AND gig_id=?";
    $array=array("Accepted",$applicantId,$gigId);
    if (insertData($sql,$conn,$array)) {
        return "success";
    }else {
        return "error";
    }
   }
   public function declineGigApplication($conn,$applicantId,$gigId){
    $sql="UPDATE gig_application SET status=? WHERE user_id=? AND gig_id=?";
    $array=array("Declined",$applicantId,$gigId);
    if (insertData($sql,$conn,$array)) {
        return "success";
    }else {
        return "error";
    }
   
   }


}

?>