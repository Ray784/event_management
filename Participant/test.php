<?php 
    date_default_timezone_set("Asia/Kolkata");
    $date=date('Y-m-d');
    echo "today: ".$date;
    $evedate=strtotime('2018-09-30');
    echo '<br>';
    echo "event on: ".$evedate;
    $date=strtotime($date);
    echo '<br>';
    echo "today: ".$date;
    echo '<br>';
    echo "event on: ".$evedate;
    $diff=$evedate-$date;
    echo '<br>';
    echo "dif is: ".$diff;
    $diff=round($diff / (60 * 60 * 24));
    echo '<br>';
    echo "dif in days is: ".$diff;
?>