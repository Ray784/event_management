<?php 
    session_start();/*Abhay*/
    require_once("classCloud.php");
    require_once("../config/connect.php");
    if(time() - $_SESSION['timeclient'] > 900) { 
        header("Location: logout.php"); 
        exit;
    } else {
        $_SESSION['timeclient'] = time(); 
    if(isset($_POST) & !empty($_POST)) {
        $c  = new CloudImages();
            $url = $_FILES['images']['tmp_name'];
            $res=$c->UploadToCloudFile($url);
            $url=$res['data'];
        
        if($res['success']==1) 
        {
            $title = mysqli_real_escape_string($connection, $_POST['title']);
        $client_id = mysqli_real_escape_string($connection, $_SESSION['idclient']);
        date_default_timezone_set("Asia/Kolkata");
        $tstamp=date('Y-m-d H:i:s');
        $content = mysqli_real_escape_string($connection, $_POST['content']);
        $ppl = mysqli_real_escape_string($connection, $_POST['ppl']);
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $venue = mysqli_real_escape_string($connection, $_POST['venue']);
        $price = mysqli_real_escape_string($connection, $_POST['price']);
        $query = "INSERT INTO `event`(client_id,title,timestamp,image_url,description,num_ppl,venue,date,price) VALUES ('$client_id','$title','$tstamp','$url','$content','$ppl','$venue','$date','$price')";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            if ($result){
                header('location: index.php');
            }
            else
            {
                $query="DELETE FROM `event` WHERE client_id='$client_id' and title='$title'";
                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                header('location: event.php?fail=true');
            }
        }
        else
            header('location: testform.php?fail=true');
    }
    }
?>