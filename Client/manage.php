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
    if(isset($_POST['manage']) & !empty($_POST['manage']))
    {
        $url=$_POST['manage'];
        $res=mysqli_query($connection,"SELECT * FROM `event` WHERE image_url='$url'");
        $blog=mysqli_fetch_array($res);
        $result=mysqli_query($connection,"SELECT user_id FROM `registrations` WHERE event_url='$url'");
        $count = mysqli_num_rows($result);
        $regs = mysqli_fetch_all($result,MYSQLI_NUM);
    }
    else
    {
        header("location: index.php");
    }
    
?>
<?php include'head.php';?>
<title>Manage Event</title>
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
        .tar{
            height:50%;
        }
    </style>
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image')
                    .attr('src', e.target.result)
            };
            <?php $_GET['src']='true';?>

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
  
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
			  
			  <a class="navbar-brand" href="index.php"><span><img src="../img/event.png" class="img responsive active" style="max-height:40px;max-width:40px;margin:-8px 0px;"/></span> Event Manager</a>
			
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
			  
			  <ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="event.php">Add Event</a></li>
				<li class="active"><a href="#">Manage Event</a></li>
				
			  </ul>
		      <ul class="nav navbar-nav navbar-right">
    			 <li class="active"><a><span></span><?php echo $user['name'];?></a></li>
    			 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    		</ul>
			</div>
		  </div>
		</nav>
<!--Content Starts here-->
		<div class="container">
			<br>
			<br>
			<br>
			<br>
			<div class="row">
			   <div class="col-md-12 col-sm-12 col-xs-12">
			    <div class="col-md-3 col-sm-6 col-xs-6">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h3>Event Title</h3>
			            </div>
			            <div class="panel-body">
			                <p><?php echo $blog['title']?></p>
			            </div>
			        </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h3>Event Date</h3>
			            </div>
			            <div class="panel-body">
			                <p><?php echo $blog['date']?></p>
			            </div>
			        </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h3>Users Registered</h3>
			            </div>
			            <div class="panel-body">
			                <p><?php echo $count?></p>
			            </div>
			        </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h3>Verification Status</h2>
			            </div>
			            <div class="panel-body">
			                <?php if($blog['approval']==1){?>
                            <p><i style="font-size:15px; color:green;" class="fa">&#xf058;Verified</i></p>
                            <?php }else{?>
                            <p><i style="font-size:15px; color:red;" class="fa">&#xf057;Not Verified</i></p>
                            <?php }?>
			            </div>
			        </div>
			    </div>
			    </div>
			</div>
			<br>
			<br>
			<div class="container">
			    <div class="row">
			        <div class="col-md-12 col-sm-12 col-xs-12">
			            <div  class="table-responsive">
			            <table class="table">
			                <?php if($count>0){?>
			                <tr class="panel panel-heading" style="background-color:#d3d3d3;">
    			                <th class="panel-heading" >S.no.</th>
    			                <th class="panel-heading" style="text-align:center;">Name</th>
    			                <th class="panel-heading" style="text-align:center;">Phone</th>
    			                <th class="panel-heading" style="text-align:center;">E-mail</th>
    			                <th class="panel-heading" style="text-align:center;">City</th>
			                </tr>
			                <?php }$s=0;
			                    foreach($regs as $reg){
			                    $resu=mysqli_query($connection,"SELECT name,email,phone,city FROM `user` WHERE email='$reg[0]'");
			                    $s++;
			                    $res=mysqli_fetch_array($resu);
			                    ?>
			                    <tr class="panel panel-heading" style="background-color:#fff; border-color:#d3d3d3;">
			                        <td class="panel-heading" style="text-align:center;border-color:#d3d3d3;"><?php echo $s.".";?></td>
			                        <td class="panel-heading" style="text-align:center;border-color:#d3d3d3;"><?php echo $res['name'];?></td>
			                        <td class="panel-heading" style="text-align:center;border-color:#d3d3d3;"><?php echo $res['phone'];?></td>
			                        <td class="panel-heading" style="text-align:center;border-color:#d3d3d3;"><?php echo $res['email'];?></td>
			                        <td class="panel-heading" style="text-align:center;border-color:#d3d3d3;"><?php echo $res['city'];?></td>
			                    </tr><?php }?>
			             </table>
			             </div>
			        </div>
			    </div>
			</div>