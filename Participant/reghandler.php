<?php include '../config/connect.php'?>
<?php
  session_start();
  require('../config/connect.php');
  if (isset($_POST) and !empty($_POST)){
    $password = md5(mysqli_real_escape_string($connection, $_POST['password']));
    $city=mysqli_real_escape_string($connection, $_POST['city']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
    $org=mysqli_real_escape_string($connection, $_POST['org']);
    $dob=mysqli_real_escape_string($connection, $_POST['dob']);
    $type="participant";
    $phnum=mysqli_real_escape_string($connection, $_POST['phnum']);
    $email=mysqli_real_escape_string($connection, $_POST['email']);
    $query = "INSERT INTO `user` (name,password,phone,DOB,type,email,Organisation,city) VALUES ('$name','$password','$phnum','$dob','$type','$email','$org','$city')";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      if($result)
      {
          header('location: login.php?rsuccess=true');
      }
    }
    else
    {
            header('location: register.php?loginFailed=true');

    }
?>