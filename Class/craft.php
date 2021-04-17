<?php

class Craft 
{
    protected $user_id;
    protected $craft_id;
    protected $craft_type;
    protected $craft_description;
    protected $craft_upload_path;

    public function __construct($conn=false,$craft_id=false){
        if (!empty($conn)&& !empty($craft_id)) {
           $sql="SELECT * FROM art WHERE art_id=?";
           $array=array($craft_id);
           $result=selectData($sql,$conn,$array);
           $this->user_id= $result['user_id'];
           $this->craft_id= $result['art_id'];
           $this->craft_type= $result['art_type'];
           $this->craft_description= $result['art_caption'];
           $this->craft_upload_path= $result['art_path'];
        }

    }
    public function getCrafttId()
    {
        return $this->craft_id;
    }
    public function getCraftType()
    {
        return $this->craft_type;
    }
    public function getCraftDescription()
    {
        return $this->craft_description;
    }
    public function getCraftUploadPath()
    {
        return $this->craft_upload_path;
    }
    public function setCrafttId($craft_id)
    {
       $this->craft_id =$craft_id ;
    }
    public function setCraftType($craft_type)
    {
       $this->craft_type =$craft_type;
    }
    public function setCraftDescription($craft_description)
    {
       $this->craft_description =$craft_description ;
    }
    public function setCraftUploadPath($craft_upload_path)
    {
       $this->craft_upload_path =$craft_upload_path ;
    }
    public function updateCraft($conn,$craft_file)
    {
        try {
            if ($craft_file['name']==null) {
                $sql="UPDATE art SET art_type=?, art_caption=? WHERE art_id=?";
                $array=array($this->craft_type,$this->craft_description,$this->craft_id);
                insertData($sql,$conn,$array);
                echo "Successful";
            }else {
                $imageFileType = strtolower(pathinfo($craft_file['name'],PATHINFO_EXTENSION));
                $array = explode( "/", $craft_file['type']);
                $craft_folder = get_content_type($array[0]);
                if($craft_folder == "Decline"){
                    echo "Ensure your upload is an image/video/audio";
                }else{
                    $old_craft_upload_path="../".$this->craft_upload_path;
                    unlink($old_craft_upload_path);
                    $craft_upload_path = $craft_folder."/craft".$this->user_id.$this->craft_id.".".$imageFileType;
                    $sql="UPDATE art SET art_type=?, art_caption=?,art_path=? WHERE art_id=?";
                    $array=array($this->craft_type,$this->craft_description,$craft_upload_path,$this->craft_id);
                    insertData($sql,$conn,$array);
                    $this->craft_upload_path=$craft_upload_path;
                    $upload_path="../".$craft_upload_path;
                    move_uploaded_file($craft_file['tmp_name'],$upload_path);
                    echo "Successful";
                } 
            }
        } catch (Exception $e) {
            throw $e;
        }
        
    }
    public function deleteCraft($conn)
    {
        try{
            $sql="DELETE FROM art WHERE art_id=?";
            $array=array($this->craft_id);
            insertData($sql,$conn,$array);// Deleting actually - _ -
            $craft_file_path="../".$this->craft_upload_path;
            unlink($craft_file_path);
            echo "Successful";
        } catch (Exception $e) {
            throw $e;
        }
    }
    
}


?>