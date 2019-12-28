<?php
session_start();/*Abhay*/
if(time() - $_SESSION['timeclient'] > 900) { 
        header("Location: logout.php"); 
        exit;
    } else {
        $_SESSION['timeclient'] = time(); 
        require_once("classCloud.php");
        require_once('../config/connect.php');
        if(isset($_POST['delete']))
        {
            $string=$_POST['delete'];
            $last = strrpos($string,'-');
            $url_id = substr($string, $last);
            $title = substr($string, 0, $last);
            $c  = new CloudImages();
            $res=$c->DeleteCloudiNaryFile($url_id);
            if($res['success']==1)
            {
                $id=mysqli_real_escape_string($connection,$_SESSION['idclient']);
                $url_id=mysqli_real_escape_string($connection,$url_id);
                $title=mysqli_real_escape_string($connection,$title);
                $query="DELETE FROM `event` WHERE client_id='$id' and title='$title'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                if($result)
                {
                    header('location: index.php');
                }
            }
            else
            {
                echo "delete unsuccessful";
            }
        }
}
?>