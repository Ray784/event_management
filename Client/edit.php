<?php
    session_start();
    if(time() - $_SESSION['timeclient'] > 900) { 
        header("Location: logout.php"); 
        exit;
    } else {
        $_SESSION['timeclient'] = time(); 
    require_once('../config/connect.php');
    if(isset($_POST['change']) & !empty($_POST['change']))
    {
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $client_id = mysqli_real_escape_string($connection, $_SESSION['idclient']);
        $content = mysqli_real_escape_string($connection, $_POST['content']);
        $ppl = mysqli_real_escape_string($connection, $_POST['ppl']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $venue = mysqli_real_escape_string($connection, $_POST['venue']);
        $price = mysqli_real_escape_string($connection, $_POST['price']);
        $url=$_POST['change'];
        $query = "UPDATE `event` SET client_id='$client_id',title='$title',description='$content',num_ppl='$ppl',venue='$venue',date='$date',price='$price' WHERE image_url='$url'";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    if ($result){
                        header("location: index.php");
                    }
        
    }
    else
    {
        echo "change is empty";
    }
    }
?>