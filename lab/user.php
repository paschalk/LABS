<?php
   include_once 'DBConnector.php';
   include('crud.php');
   include('authenticator.php');
   include "fileUploader.php";

 
  //$conn = new DBConnector;

   class User implements Crud,Authenticator {
       private $user_id;
       private $first_name;
       private $last_name;
       private $user_city;

       private $username;
       private $password;

       //private $profile_image;
       

       //private $utc_timestamp;
       //private $time_zone_offset;


       private static $target_directory="uploads/";

       function __construct($first_name,$last_name,$user_city,$username,$password)
       {
          $this->first_name = $first_name;
          $this->last_name = $last_name;
          $this->user_city = $user_city;
          $this->username=$username;
          $this->password=$password;
          //$this->profile_image=$profile_image;
          //$this->utc_timestamp = $utc_timestamp;
          //$this->time_zone_offset = $time_zone_offset;
       }

       public static function create()
       {
          $instance = new self("","","","","");
           return $instance;
       }
       public function setUsername($username)
       {
           $this->username = $username;
       }
       public function getUsername()
       {
          return $this->username;
       }

       public function setPassword($password)
       {
           $this->password = $password;
       }
       public function getPassword()
       {
          return $this->password;
       }

       public function setUserId($user_id)
       {
           $this->user_id = $user_id;
       }
       public function getUserId()
       {
          return $this->user_id;
       }
       public function save()
       {
           $fn = $this->first_name;
           $ln = $this->last_name;
           $city = $this->user_city;
           $uname = $this->username;
           $this->hashPassword();
           $pass = $this->password;
           //$profile_image = $this->profile_image;
           //$utc_timestamp = $this->utc_timestamp;
           //$time_zone_offset = $this->time_zone_offset;

           $file_name=$_FILES["fileToUpload"]["name"];
           $dir=self::$target_directory.$file_name;

           $con = new DBConnector;


            $res = mysqli_query($con->conn,"INSERT INTO userd(first_name,last_name,user_city,username,password,file_name,file_dir)  VALUES('$fn','$ln','$city','$uname','$pass','$file_name','$dir')");


           return $res;
       }
       public function readAll(){
           return null;
       }
       public function readUnique(){
        return null;
       }
       public function search(){
        return null;
       }
       public function update(){
        return null;
       }
       public function removeOne(){
        return null;
       }
       public function removeAll(){
        return null;
       }
       public function valiteForm()
       {
           $fn = $this->first_name;
           $ln = $this->last_name;
           $city = $this->user_city;

           if($fn == "" || $ln == "" || $city =="")
           {
               return false;
           }
           return true;
       }
       public function createFormErrorSessions()
       {
           session_start();
           $_SESSION['form_errors'] = "All fields are required";
       }

       public function hashPassword()
       {
           $this->password = password_hash($this->password,PASSWORD_DEFAULT);
       }
   
       public function isPasswordCorrect()
       {
           $con = new DBConnector;
           $found = false;
           $res = mysqli_query($con->conn,"SELECT * FROM user");

           while($row = mysqli_fetch_array($res))
           {
               if(password_verify($this->getPassword(), $row['password']) && $this->getUsername() == $row['username'])
               {
                   $found = true;
               }
           }
           $con->closeDatabase();
           return $found;
       }
       public function login()
       {
           if($this->isPasswordCorrect())
           {
               header("Location:private_page.php");
           }
       }
       public function createUserSession(){
           session_start();
           $_SESSION['username'] = $this->getUsername();
       }
       public function logout()
       {
           session_start();
           unset($_SESSION['username']);
           session_destroy();
           header("Location:lab1.php");
       }
    }  
?>