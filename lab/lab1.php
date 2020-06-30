<?php
  include_once 'DBConnector.php';
  include_once 'user.php';
  include_once 'fileUploader.php';


  $con = new DBConnector;

  if(isset($_POST['btn-save']))
  {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $city = $_POST['user_city'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      //$profile_image = $_POST['profile_image'];

      $utc_timestamp = $_POST['utc_timestamp'];
      $time_zone_offset = $_POST['time_zone_offset'];

       $user = new User($first_name,$last_name,$city,$username,$password);

       $uploader = new FileUploader;

      if(!$user->valiteForm())
      {
        $user->createFormErrorSessions();
        header("Refresh:0");
        die();
      }
      $res = $user->save();


      $file_upload_response = $uploader->uploadFile();

  

   if($res)
   {
      echo "Save Operation was successful";
      
   }
   else{
      echo "An error occurred";
   }
  }
?>


<!DOCTYPE html>
<html>
    <head>
      <title>Registration Form</title>
      <script type = "text/javacsript" src = "validate.js"></script>
      <link rel = "stylesheet" type = "text/css" href = "validate.css">

      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type = "text/javascript" src = "timezone.js"></script>
    </head>
<body>
    <form method = "post" name = "user_details" enctype="multipart/form-data" id = "user_details" onsubmit = "return validateForm()" action = "<?=$_SERVER['PHP_SELF']?>">
       <table align = "centre">
           <tr>
             <td>
               <div id = "form-errors">
                 <?php
                    session_start();
                    if(!empty($_SESSION['form-errors']))
                    {
                      echo " " . $_SESSION['form_errors'];
                      unset($_SESSION['form_errors']);
                    }
                 ?>
               </div>
             </td>
           </tr>
           <tr>
             <td><input type = "text" name = "first_name" required placeholder = "First Name"/></td>
            </tr>
            <tr>
             <td><input type = "text" name = "last_name" required placeholder = "Last Name"/></td>
            </tr>
            <tr>
             <td><input type = "text" name = "user_city" required placeholder = "City"/></td>
            </tr>
            <tr>
             <td><input type = "text" name = "username"  required placeholder = "Username"/></td>
            </tr>
            <tr>
             <td><input type = "password" name = "password"  required placeholder = "Password"/></td>
            </tr>
            
            <tr>
              <td>Profile Image: <input type = "file" name="fileToUpload" id="fileToUpload"></td>
            </tr>
            
            <tr>
              <td><button type = "submit" name = "btn-save"><strong>SAVE</strong></td>
            </tr>
            
            <input type = "hidden" name = "utc_timestamp" id = "utc_timestamp" value = ""/>
            <input type = "hidden" name = "time_zone_offset" id = "time_zone_offset" value = "" />
            
            <tr>
              <td><a href = "login.php">Login</a><td>
            </tr>
       </table>
    </form>
</body>
</html>