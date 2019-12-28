<?php
    session_start();
    require('../config/connect.php');
    if(isset($_SESSION['idpar']) & !empty($_SESSION['idpar']))
    {
		$userLoggedIn=$_SESSION['idpar'];
        $user_details_query = mysqli_query($connection, "SELECT * FROM `user` WHERE email='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
        $url="http://res.cloudinary.com/event078/";
    }
    else
    {
        header("location: login.php");
    }
    if(time() - $_SESSION['timepar'] > 900) { 
        header("Location: logout.php"); 
        exit;
    } else {
        $_SESSION['timepar'] = time(); 
    }
?>
<!doctype html>
<!--Abhay-->
<html lang="en">
  <head>
   
   <!-- Required meta tags -->
    
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS/CSS scripts -->
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Icon -->
	<link rel="icon" type="image/gif" href="../img/event.png" />
    
	<title>Feed</title>
	<style>
	@font-face {
            font-family: 'myFont'; /*a name to be used later*/
            src: url('../fonts/BRLNSR.TTF'); /*URL to font*/
        }
        .font{
            font-family:myFont;
            font-size:18px;
        }
        .image{
            width: 40%;
            height:40%;
        }
    </style>
  </head>
  <body>
		
		 <nav class="navbar navbar-inverse navbar-fixed-top" style="margin:-2px -2px;">
		  <div class="container-fluid">
			<div class="navbar-header">
			  
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			  </button>
			  
			  <a class="navbar-brand" href="index.php"><span><img src="../img/event.png" class="img responsive" style="max-height:40px;max-width:40px;margin:-8px 0px;"/></span> Event Manager</a>
			
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
			  
			  <ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="reg.php">Registrations</a></li>
			  </ul>
		      <ul class="nav navbar-nav navbar-right">
    			 <li class="active"><a><span></span><?php echo $user['name'];?></a></li>
    			 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    		</ul>
			</div>
		  </div>
		</nav>
		<br>
		<br>
		<br>
		<br>
		<?php if(isset($_GET['reg'])){ ?><div class="alert alert-success" role="alert"> <?php echo "You have already registered to that event"; ?> </div><?php } ?>
		<?php if(isset($_GET['addreg'])){ ?><div class="alert alert-success" role="alert"> <?php echo "Registration Added Successfully"; ?> </div><?php } ?>
		<?php if(isset($_GET['a'])){ ?><div class="alert alert-danger" role="alert"> <?php echo "Cannot Register : Selected Event Not Verified"; ?> </div><?php } ?>
			<?php if(isset($_GET['exp'])){ ?><div class="alert alert-danger" role="alert"> <?php echo "Registrations ended or Event ended"; ?> </div><?php } ?>
		<?php
		        $event=0;
        		$result = mysqli_query($connection,"SELECT * FROM `event` ORDER BY timestamp DESC");
        		while($blog = mysqli_fetch_array($result))
                {
                    $id=$blog['client_id'];
                    $event=1;
                    $author_query = mysqli_query($connection, "SELECT * FROM `user` WHERE email='$id'")or die(mysqli_error($connection));
                    $count = mysqli_num_rows($author_query);
                    $image=$blog['image_url'];
                    if($count==1){
                    $author = mysqli_fetch_array($author_query);
                    ?>
		        <div class="container">
		            <div class="col-md-10 col-xs-12 col-sm-12 col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title"><?php echo $blog['title'];?></h2>
                                <?php if($blog['approval']==1){?>
                                    <i style="font-size:15px; color:green;" class="fa">&#xf058; Verified</i>
                                <?php }else{?>
                                    <i style="font-size:15px; color:red;" class="fa">&#xf057; Not Verified</i>
                                <?php }?>
                            </div>
                            <div class="panel-body">
                                    <?php 
                                    $url1=$url.$blog['image_url'];
                                    ?>
                                    <img src="<?php echo $url1?>" class="col-md-4 col-xs-8 col-sm-8 col-lg-4">
                            </div>
                            <div class="panel-body">
                                 <p><strong>Description:</strong><br></p>
                                 <p><?php echo $blog['description']; ?></p>
                                 <br>
                                 <p><strong>Price: </strong><?php echo $blog['price'];?><br></p>
                                 <p><strong>Date: </strong><?php echo $blog['date'];?><br></p>
                                 <p><strong>Venue: </strong><?php echo $blog['venue'];?><br></p>
                            </div>
                            <div class="panel-footer">
                                <div class="container">
                                    <div class="row-main">
                                        <div class="col-md-8 col-sm-8 col-xs-8 col-lg-8">
                                            <b><?php echo 'Written by '.$author['Organisation'].' on '.$blog['timestamp']; ?></b>
                                        </div>
                                        
                                        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2">
                                            <form method="post" action="addreg.php"><button type="submit" name="reg" id="reg" value="<?php echo $blog['image_url'].'-'.$_SESSION['idpar'];?>" class="btn btn-warning">Register</button></form><?php }?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
		            </div>
		        </div>
		<?php  }
		if($event==0){?>
		<div class="container">
		            <div class="col-md-10 col-xs-12 col-sm-12 col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2>Event Title</h2>
                            </div>
                            <div class="panel-body">
                                <p>Events will be shown here</p>
                                <p>Currently no active events available to show</p>
                            </div>
                        </div>
                    </div>
		</div>
		<?php }?>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		</body>
	</html>