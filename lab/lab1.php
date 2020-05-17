<?php
  include_once 'DBConnector.php';
  include_once 'user.php';

  $con = new DBConnector;

  if(isset($_POST['btn-save']))
  {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $city = $_POST['user_city'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      $user = new User($first_name,$last_name,$city,$username,$password);

      if(!$user->valiteForm())
      {
        $user->createFormErrorSessions();
        header("Refresh:0");
        die();
      }
      $res = $user->save($con->conn);
  

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
    </head>
<body>
    <form method = "post" name = "user_details" id = "user_details" onsubmit = "return validateForm()" action = "<?=$_SERVER['PHP_SELF']?>">
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
              <td><button type = "submit" name = "btn-save"><strong>SAVE</strong></td>
            </tr>
            <tr>
              <td><a href = "login.php">Login</a><td>
            </tr>
       </table>
    </form>
</body>
</html>