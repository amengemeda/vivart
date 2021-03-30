<?php

class User 
{
    protected $user_id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $description;
    protected $password;
    protected $profile_photo;
    protected $is_verified;
    protected $user_type;

    public function __construct($user_id=false,$conn=false){
      // The constructor has two ways of implementations:
      //1.It will fetch all the data from the database when it is called
      //2. Basically, it will not do anything apart from being used to create objects
        if ($conn!=false && $user_id!=false) {
        $sql="SELECT * FROM user WHERE user_id=?";
        $array=[$user_id];
        $this->user_id=$user_id;
        $result=selectData($sql,$conn,$array);
        if($result!=null){
            $this->first_name=$result["first_name"];
            $this->last_name=$result["last_name"];
            $this->email=$result["email"];
            $this->description=$result["description"];
            $this->password=$result["password"];
            $this->profile_photo=$result["profile_photo"];
            $this->is_verified=$result["is_verified"];
            $this->user_type= $result["user_type"];   
        }
       }
        
    }
    public function getFirstName(){
        return $this->first_name;
    }
    public function getLastName(){
        return $this->last_name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getUserType(){
        return $this->user_type;
    }
    public function getProfilePicture(){
        return $this->profile_photo;
    }
    public function setFirstName($first_name){
        $this->first_name=$first_name;
    }
    public function setLastName($last_name){
        $this->last_name=$last_name;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function setUserType($user_type){
        $this->user_type=$user_type;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function setPassword($password){
        $this->password=password_hash($password,PASSWORD_DEFAULT);
    }
    public function setProfilePicture($profile_photo){
        $this->profile_photo=$profile_photo;
    }
    public function login($email, $password, $conn){
        try{
            $sql = 'SELECT password FROM user WHERE email = ?';
            $array = [$email];
            $result = selectData($sql, $conn, $array);
            if($result == null){
                return "This account does not exist";
            }
            if(password_verify($password,$result['password'])){               
                $sql = 'SELECT user_id,first_name,last_name FROM user WHERE email = ?';
                $array = [$email];
                $result = selectData($sql, $conn, $array);
                session_start();
                $_SESSION["user_id"] = $result['user_id'];
                $_SESSION["first_name"] = $result['first_name'];
                $_SESSION["last_name"] = $result['last_name'];
                // return "<script>window.location.href = 'Landing.php'</script>";
                return "Successful";
            }
            return "Your username or password is incorrect";
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    

    public function register($conn){
        // to be implemented by Amen
    $sql= "INSERT INTO user (first_name,last_name,email,user_type,password) VALUES(?,?,?,?,?)";
    $array=[$this->first_name, $this->last_name,$this->email,$this->user_type,$this->password];
    insertData($sql,$conn,$array);
    echo "success";
}
   public function addEvent($conn,$event_name,$description,$file){
       $sql1="SELECT MAX(event_id) as last_Id FROM event";
       $array= array();
       $result= selectData($sql1,$conn,$array);
       $imageFileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
       $array = explode( "/", $file['type']);
            $craft_folder = get_content_type($array[0]);
            if($craft_folder == "Decline"){
                echo "Ensure your upload is an image/video/audio";
            }else{
                $event_upload_path="$craft_folder/event".$this->user_id.$result['last_Id'].".".$imageFileType;
                $sql2="INSERT INTO event (user_id,event_name,event_description,event_upload_path) VALUES(?,?,?,?)";
                $array2= array($this->user_id,$event_name,$description,$event_upload_path); 
                insertData($sql2,$conn,$array2);
                $upload_path="../".$event_upload_path;
                move_uploaded_file($file['tmp_name'],$upload_path);
                echo "Successful";
            }
       
   }

   public function getEventsUploaded($conn){
       $sql="SELECT event_id,event_name,event_description,event_upload_path FROM event WHERE user_id=?";
       $array=array($this->user_id);
       $result=selectAllData($sql,$conn,$array);
       return $result; 
   }
   public function getCraftsUploaded($conn){
       $sql="SELECT art_id,art_type,art_caption,art_path FROM art WHERE user_id=?";
       $array=array($this->user_id);
       $result=selectAllData($sql,$conn,$array);
       return $result; 
    }

   public function logout(){
       session_unset();
       session_destroy();
   }
    
}




?>