<?php
    session_start();
    require('../config/connect.php');
    if(isset($_SESSION['idclient']) & !empty($_SESSION['idclient']))
    {
		$userLoggedIn=$_SESSION['idclient'];
        $user_details_query = mysqli_query($connection, "SELECT * FROM `user` WHERE email='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
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
    
	<title>Event Form</title>
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
			  
			  <a class="navbar-brand" href="index.php"><span><img src="../img/event.png" class="img responsive" style="max-height:40px;max-width:40px;margin:-8px 0px;"/></span> Event Manager</a>
			
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
			  
			  <ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li class="active"><a href="event.php">Add Event</a></li>
				
			  </ul>
		      <ul class="nav navbar-nav navbar-right">
    			 <li class="active"><a><span></span><?php echo $user['name'];?></a></li>
    			 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    		</ul>
			</div>
		  </div>
		</nav>
		
	
		<div class="container">
		
			<br>
			<br>
			<br>
			<br>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<form method="post" action="uploadevent.php" enctype="multipart/form-data">
						    <h3 style="font-family:myFont;">Event Uploads</h3>
						    <div class="form-group">
							    <label for="title" class="font">Title</label>
									<input type="id" class="form-control" id="title" name="title" 
									placeholder="Title Here..." required="true">
							</div>
							<div class="form-group">
							    <label for="ppl" class="font">Expected Attendance</label>
									<input type="number" min="1000" max="2000" class="form-control" id="ppl" name="ppl" 
									placeholder="Number Here..." required="true">
							</div>
							<div class="form-group">
							    <label for="price" class="font">Ticket Price</label>
									<input type="number" min="0" max="2000" class="form-control" id="price" name="price" 
									placeholder="Price in ₹ Here..." required="true">
							</div>
							<div class="form-group">
							    <label for="venue" class="font">Venue</label>
							    <div class="col-md-12">
							        <div class="col-md-6">
									<textar id="editor1" class="tar"></textar>
									</div>
									<div class="col-md-1">
									    <br>
									    <br>
									    <br>
									    <button type="button" class="btn btn-warning" style="display:block; margin-left:auto; margin-right:auto;" class="form-control" onclick="copye1()">&#x21D4</button>
									    <br>
									    <br>
									    <br>
									</div>
									<div class="col-md-5">
									<textarea class="form-control readonly" onfocus="blur();" id="venue" name="venue" rows="12"
									placeholder="Full Address Here...&#13;&#10;(write it in the editor and press &#x21D4 button)&#13;&#10;press shift+enter for next line in editor" style="resize:none;" required="true"></textarea>
									<br>
									</div>
								</div>
							</div>
							<br>
							<br>
							<div class="form-group">
							    <label for="date" class="font">Event Date</label>
									<input type="date" min="<?php date_default_timezone_set("Asia/Kolkata"); echo date('Y-m-d');?>" class="form-control" id="date" name="date"
									placeholder="Date of Event Here..." required="true">
							</div>
							<div class="form-group">
								<label for="image" class="font">Image</label>
									<input type="file" class="form-control" id="images" name="images" onchange="readURL(this);" accept="image/*" name="image" 
									placeholder="Image Here... If any...." required="true">
							</div>
							<div class="form-group">
                                <?php if(isset($_GET['src'])){?><img id="image" class="image" src="#" /><?php } ?>
                            </div>
							<div class="form-group">
								<label for="content" class="font">Description</label>
								    <textar id="editor2"></textar>
								    <br>
								    <div>
								    <button type="button" class="btn btn-warning" style="margin-left:auto; margin-right:auto; display:block;" class="form-control" onclick="copye2()">&#x21D5</button>
								    </div>
								    <div>
								        <br>
								    </div>
									<textarea class="form-control readonly" onfocus="blur();" id="content" name="content" rows="11" 
									placeholder="About Event...&#13;&#10;(write it in the editor and press &#x21D5 button)&#13;&#10;press shift+enter for next line in editor" required="true"></textarea>
							</div>
							<button type="submit" style="display:block; width:40%; margin-left:auto; margin-right:auto;" class="btn btn-warning">Submit</button>
						</form>
					</div>
				</div>
				
				<br>
				<br>
				<br>
				<br>
				
		</div>
    <!-- Optional JavaScript -->
    <script>
        //var content =  tinyMCE.getContent('editor1');
        function copye1() {
            var content=tinyMCE.get('editor1').getContent()
            document.getElementById("venue").value = content;
        }
        function copye2() {
            var content=tinyMCE.get('editor2').getContent()
            document.getElementById("content").value = content;
        }
        $(".readonly").keydown(function(e){
            e.preventDefault();
        });
        $('.readonly').bind("cut copy paste",function(e) {
            e.preventDefault();
        });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  </body>
</html>