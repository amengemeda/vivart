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
    public function login(){
        //to be implemented by Georgina
    }

    public function registeration(){
        // to be implemented by Amen
    }
    
}




?>