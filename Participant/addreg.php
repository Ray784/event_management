<?php
    require_once("../config/connect.php");
    session_start();
    if(time() - $_SESSION['timepar'] > 900) { 
        header("Location: logout.php"); 
        exit;
    } else {
            $_SESSION['timepar'] = time(); 
            if(isset($_POST['reg']))
            {
            $string=$_POST['reg'];
            $last = strrpos($string,'-');
            $usr_id = substr($string, $last+1);
            $url = substr($string, 0, $last);
            $a=0;
            date_default_timezone_set("Asia/Kolkata");
            $date=date("Y-m-d");
            $query="SELECT * FROM `event` WHERE image_url='$url'";
            $re= mysqli_query($connection, $query) or die(mysqli_error($connection));
            $event= mysqli_fetch_array($re);
            $curdate=strtotime($event['date']);
            $curdate = date('Y-m-d',$curdate);
            if($curdate <= $date)
            {
                header("location:index.php?exp=true");
            }
            else if($event['approval']==$a)
            {
                header("location:index.php?a=true");
            }
            else
            {
                $query="SELECT * FROM `registrations` WHERE user_id='$usr_id' AND event_url='$url'";
                $res = mysqli_query($connection, $query) or die(mysqli_error($connection));
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    header("location:index.php?reg=true");
                }
                else
                {
                    $query="INSERT INTO `registrations`(user_id,event_url) VALUES ('$usr_id','$url')";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    if ($result)
                    {
                        header("location:index.php?addreg=true");
                    }
                }
            }
        }
    }
    
?>