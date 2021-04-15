<?php

class Event 
{
    protected $user_id;
    protected $event_id;
    protected $event_name;
    protected $event_description;
    protected $event_upload_path;

    public function __construct($conn=false,$event_id=false){
        if (!empty($conn)&& !empty($event_id)) {
           $sql="SELECT * FROM event WHERE event_id=?";
           $array=array($event_id);
           $result=selectData($sql,$conn,$array);
           $this->user_id= $result['user_id'];
           $this->event_id= $result['event_id'];
           $this->event_name= $result['event_name'];
           $this->event_description= $result['event_description'];
           $this->event_upload_path= $result['event_upload_path'];
        }

    }
    public function getEventId()
    {
        return $this->event_id;
    }
    public function getEventName()
    {
        return $this->event_name;
    }
    public function getEventDescription()
    {
        return $this->event_description;
    }
    public function getEventUploadPath()
    {
        return $this->event_upload_path;
    }
    public function setEventId($event_id)
    {
       $this->event_id =$event_id ;
    }
    public function setEventName($event_name)
    {
       $this->event_name =$event_name;
    }
    public function setEventDescription($event_description)
    {
       $this->event_description =$event_description ;
    }
    public function setEventUploadPath($event_upload_path)
    {
       $this->event_upload_path =$event_upload_path ;
    }
    public function updateEvent($conn,$event_file)
    {
      
        try {
            if($event_file['name']==null){
                $sql="UPDATE event SET event_name=?, event_description=? WHERE event_id=?";
                $array=array($this->event_name,$this->event_description,$this->event_id);
                insertData($sql,$conn,$array);
                echo "Successful";
            }else {
                $imageFileType = strtolower(pathinfo($event_file['name'],PATHINFO_EXTENSION));
                $array = explode( "/", $event_file['type']);
                $event_folder = get_content_type($array[0]);
                if($event_folder == "Decline"){
                    echo "Ensure your upload is an image/video/audio";
                }else{
                    $old_event_upload_path="../".$this->event_upload_path;
                    unlink($old_event_upload_path);
                    $event_upload_path = $event_folder."/event".$this->user_id.$this->event_id.".".$imageFileType;
                    $sql="UPDATE event SET event_name=?, event_description=?,event_upload_path=? WHERE event_id=?";
                    $array = array($this->event_name,$this->event_description,$event_upload_path,$this->event_id); 
                    insertData($sql,$conn,$array);
                    $this->event_upload_path=$event_upload_path;
                    $upload_path="../".$event_upload_path;
                    move_uploaded_file($event_file['tmp_name'],$upload_path);
                    echo "Successful";
                } 
            }
        } catch (Exception $e) {
           throw $e ;
        }
        
    }
    public function deleteEvent($conn)
    {
        try {
            $sql="DELETE FROM event WHERE event_id=?";
            $array=array($this->event_id);
            insertData($sql,$conn,$array);// Deleting actually - _ -
            $event_file_path="../".$this->event_upload_path;
            unlink($event_file_path);
            echo "Successful";
        } catch (Exception $e) {
            throw $e;
        }
    }
}


?>