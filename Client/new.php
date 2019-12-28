<?php
    require_once("../config/connect.php");
    $type="participant";
    $query1="SELECT city,email,user_name into `s` from user WHERE type='$type'";
    $result=mysqli_query($connection,$query1);
    $query2="SELECT * INTO `p` FROM `event` FULL OUTER JOIN `registrations` on event.image_url=registrations.event_url";
    $result=mysqli_query($connection,$query2);
    $query3="SELECT * FROM `s` FULL OUTER JOIN `p` on p.user_id=s.email WHERE NOT s.city=p.city";
    $result=mysqli_query($connection,$query3);
    while($list=mysqli_fetch_array($result))
    {
        echo $list['name']."    ".$list['user_id'].'<br>';
    }
?>