<?php
session_start();/*Abhay*/
require_once("classCloud.php");
require_once('../config/connect.php');
if(isset($_POST['del']))
{
    $url_id=$_POST['del'];
    $title = substr($string, 0, $last);
    $id=mysqli_real_escape_string($connection,$_SESSION['idclient']);
    $url_id=mysqli_real_escape_string($connection,$url_id);
    $title=mysqli_real_escape_string($connection,$title);
    $query="DELETE FROM `event` WHERE image_url='$url_id'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $c  = new CloudImages();
    $res=$c->DeleteCloudiNaryFile($url_id);
    if($result & $res)
    {
        header('location: index.php');
    }
}
?>