<?php

class Gig 
{
    protected $user_id;
    protected $gig_id;
    protected $gig_name;
    protected $gig_description;
    protected $gig_upload_path;

    public function __construct($conn=false,$gig_id=false){
        if (!empty($conn)&& !empty($gig_id)) {
           $sql="SELECT * FROM gig WHERE gig_id=?";
           $array=array($gig_id);
           $result=selectData($sql,$conn,$array);
           $this->user_id= $result['user_id'];
           $this->gig_id= $result['gig_id'];
           $this->gig_name= $result['gig_name'];
           $this->gig_description= $result['gig_description'];
           $this->gig_upload_path= $result['gig_upload_path'];
        }

    }
    public function getGigId()
    {
        return $this->gig_id;
    }
    public function getGigName()
    {
        return $this->gig_name;
    }
    public function getGigDescription()
    {
        return $this->gig_description;
    }
    public function getGigUploadPath()
    {
        return $this->gig_upload_path;
    }
    public function setGigId($gig_id)
    {
       $this->gig_id =$gig_id ;
    }
    public function setGigName($gig_name)
    {
       $this->gig_name =$gig_name;
    }
    public function setGigDescription($gig_description)
    {
       $this->gig_description =$gig_description ;
    }
    public function setGigUploadPath($gig_upload_path)
    {
       $this->gig_upload_path =$gig_upload_path ;
    }
    public function updateGig($conn,$gig_file)
    {
      
        try {
            if($gig_file['name']==null){
                $sql="UPDATE gig SET gig_name=?, gig_description=? WHERE gig_id=?";
                $array=array($this->gig_name,$this->gig_description,$this->gig_id);
                insertData($sql,$conn,$array);
                echo "Successful";
            }else {
                $imageFileType = strtolower(pathinfo($gig_file['name'],PATHINFO_EXTENSION));
                $array = explode( "/", $gig_file['type']);
                $gig_folder = get_content_type($array[0]);
                if($gig_folder == "Decline"){
                    echo "Ensure your upload is an image/video/audio";
                }else{
                    $old_gig_upload_path="../".$this->gig_upload_path;
                    unlink($old_gig_upload_path);
                    $gig_upload_path = $gig_folder."/gig".$this->user_id.$this->gig_id.".".$imageFileType;
                    $sql="UPDATE gig SET gig_name=?, gig_description=?,gig_upload_path=? WHERE gig_id=?";
                    $array = array($this->gig_name,$this->gig_description,$gig_upload_path,$this->gig_id); 
                    insertData($sql,$conn,$array);
                    $this->gig_upload_path=$gig_upload_path;
                    $upload_path="../".$gig_upload_path;
                    move_uploaded_file($gig_file['tmp_name'],$upload_path);
                    echo "Successful";
                } 
            }
        } catch (Exception $e) {
           throw $e ;
        }
        
    }
    public function deleteGig($conn)
    {
        try {
            $sql="DELETE FROM gig WHERE gig_id=?";
            $array=array($this->gig_id);
            insertData($sql,$conn,$array);// Deleting actually - _ -
            $gig_file_path="../".$this->gig_upload_path;
            unlink($gig_file_path);
            echo "Successful";
        } catch (Exception $e) {
            throw $e;
        }
    }
}


?>