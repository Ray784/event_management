<?php
    session_start();
    if(time() - $_SESSION['timeadmin'] > 900) { 
        header("Location: logout.php"); 
        exit;
    } else {
        $_SESSION['timeadmin'] = time(); 
    require_once('../config/connect.php');
    if(isset($_POST['approve']) & !empty($_POST['approve']))
    {
        $url=$_POST['approve'];
        $approve=1;
        $query = "UPDATE `event` SET approval='$approve' WHERE image_url='$url'";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    if ($result){
                        header("location: index.php");
                    }
        
    }
    }
?>