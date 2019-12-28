<?php
	session_start();
	require('connect.php');
	if(isset($_POST['submit'])){
		$user= $_POST['email'];
		$pwd=$_POST['pwd'];
		//echo $user.$pwd;
		$query="select * from login where email='$user' and password='$pwd'";
		$result=mysqli_query($connection,$query) or die(mysqli_error($connection));
		$count=mysqli_num_rows($result);
		//echo $count;
		if($count == 1){
			$_SESSION['email'] = $user;
			$_session['password']=$pwd;
			
			}
		else{
			$fmsg="invalid login credencials";
		}
	}else{
	    echo "no values added";
	    
	}
	if(isset($_SESSION['email'])){
		$user=$_SESSION['email'];
		header("Location: after_login.php");
	}else{
		
		header('Location: login.php');
	}
	
?>