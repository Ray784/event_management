<?php include '../config/connect.php'?>
<?php
  session_start();
  require('../config/connect.php');
  if (isset($_POST) and !empty($_POST)){
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $type="client";
    $password = md5(mysqli_real_escape_string($connection, $_POST['password']));
    $query="SELECT * FROM `user` WHERE email='$id' and password='$password' and type='$type'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    if ($count == 1){
      $_SESSION['idclient'] = $id;
      $_SESSION['timeclient'] = time();
        header('location: index.php');
    }
    else
    {
            header('location: login.php?loginFailed=true');

    }
}
?>