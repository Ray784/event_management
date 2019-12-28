<?php
    session_start();
    require('../config/connect.php');
    if(isset($_SESSION['idclient']) & !empty($_SESSION['idclient']))
    {
		$userLoggedIn=$_SESSION['idclient'];
        $user_details_query = mysqli_query($connection, "SELECT * FROM `user` WHERE email='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
        $url="http://res.cloudinary.com/event078/";
    }
    else
    {
        header("location: login.php");
    }
    if(time() - $_SESSION['timeclient'] > 900) { 
        header("Location: logout.php"); 
        exit;
    } else {
        $_SESSION['timeclient'] = time(); 
    }
?>
<?php include'head.php';?>
    
	<title>Home</title>
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
        .center{
            margin-left:auto;
            margin-right:auto;
            display:block;
            
        }
    </style>
  </head>
   <?php
        function is_url_exist($url){
            $ch = curl_init($url);    
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
            if($code == 200){
               $status = true;
            }else{
              $status = false;
            }
            curl_close($ch);
           return $status;
        }
    ?>
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
				<li><a href="event.php">Add Event</a></li>
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
		<?php
		        $event=0;
        		$result = mysqli_query($connection,"SELECT * FROM `event` order by timestamp DESC");
        		while($blog = mysqli_fetch_array($result))
                {
                    $id=$blog['client_id'];
                    if($blog['client_id']==$userLoggedIn)
                    { $event=1;?>
		        <div class="container">
		            <div class="col-md-10 col-xs-12 col-sm-12 col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="container">
                                    <div class="row-main">
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                            <h2 class="panel-title"><?php echo $blog['title'];?></h2>
                                            <?php if($blog['approval']==1){?>
                                                <i style="font-size:15px; color:green;" class="fa">&#xf058;Verified</i>
                                            <?php }else{?>
                                                <i style="font-size:15px; color:red;" class="fa">&#xf057;Not Verified</i>
                                            <?php }?>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                            <form method="post" action="editevent.php"><button type="submit" name="edit" id="edit" value="<?php echo $blog['image_url'];?>" class="btn btn-warning center">Edit Event</button></form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="panel-body">
                                    <?php 
                                    $url1=$url.$blog['image_url'];
                                    if(!is_url_exist($url1))
                                    {$url1="../img/event.png";}?>
                                    <img src="<?php echo $url1?>" class="col-md-4 col-xs-8 col-sm-8 col-lg-4">
                            </div>
                            <div class="panel-body">
                                    <p><strong>Description:</strong><br></p>
                                 <p><?php echo $blog['description']; ?></p>
                                 <br>
                                 <p><strong>Price:</strong> <?php echo $blog['price'];?><br></p>
                                 <p><strong>Date:</strong> <?php echo $blog['date'];?><br></p>
                                 <p><strong>Venue:</strong> <?php echo $blog['venue'];?><br></p>
                            </div>
                            <div class="panel-footer">
                                <div class="container">
                                    <div class="row-main">
                                        <div class="col-md-4 col-xs-6 col-sm-6 col-lg-4">
                                            <b><?php echo 'Event by '.$user['Organisation'];?><br><?php echo 'Uploaded on '.$blog['timestamp']; ?></b>
                                        </div>
                                        <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
                                            <form method="post" action="deletevent.php"><button type="submit" name="delete" id="delete" onclick="return confirm('Are you sure?')" value="<?php echo $blog['title']."-".$blog['image_url'];?>" class="btn btn-warning center">Delete</button></form>
                                        </div>
                                        <div class="col-xs-1 col-sm-1">
                                            
                                        </div>
                                        <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
                                            <form method="post" action="manage.php"><button type="submit" name="manage" id="manage" value="<?php echo $blog['image_url'];?>" class="btn btn-warning center">Manage</button></form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
		            </div>
		        </div>
		<?php  }} 
		if($event==0){?>
		<div class="container">
		            <div class="col-md-10 col-xs-10 col-sm-10 col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2>Event Title</h2>
                            </div>
                            <div class="panel-body">
                                <p>Your events will be shown here</p>
                                <p>Currently no active events available to show</p>
                            </div>
                            <div class="panel-footer">
                                <div class="container">
                                    <div class="row-main">
                                        <div class="col-md-8 col-xs-8 col-sm-8 col-lg-8">
                                            Add an event by clicking on AddEvent.
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                                            <a class="btn btn-warning" href="event.php">Add Event</a>
                                        </div>
                                    </div>
                                </div>
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