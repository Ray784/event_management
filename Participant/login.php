<!DOCTYPE html>
<!--Abhay-->
<html>
<head>
  <title>
     Login
  </title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	@font-face {
            font-family: 'myFont'; /*a name to be used later*/
            src: url('../fonts/BRLNSR.TTF'); /*URL to font*/
        }
    .font{
        font-family:myFont;
        
        font-size:18px;
    }
    .login {
        background-color: #d3d3d3;
    }
    .clogin{
        background-color: #fff;
        border-radius:2%;
        padding: 3%;
    }
    @media (max-width: 978px) {
        .clogin{
        background-color: #fff;
        border-radius:2%;
        padding: 6%;
    }
    }
   
</style>
</head>
<body class="login">
    <br>
    <br>
    <br>
    <br>
        <div class="container" >
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-md-4 col-xs-1 col-sm-1 col-lg-4">
                    
                </div>
                <div class="col-md-4 col-xs-10 col-sm-10 col-lg-4 clogin">
        <div>
            <img src="../img/event.png" style="height:60%; width:60%; border-radius:2%; display:block; margin-left:auto; margin-right:auto;">
            <h2 class="font" style="text-align:center;">Login to participate in an event</h2>
        </div>
        <div class="main-login main-center">
            <br>
            <?php if(isset($_GET['loginFailed'])){ ?><div class="alert alert-danger" role="alert"> <?php echo "Invalid Login Credentials"; ?> </div><?php } ?>
            <?php if(isset($_GET['rsuccess'])){ ?><div class="alert alert-success" role="alert"> <?php echo "Registration Successful"; ?> </div><?php } ?>
            <form class="form-horizontal" method="post" action="validate.php">
            <div class="form-group">
              <label for="id" class="font">Email: </label>
              <input type="email" class="form-control" name="id" id="id"  placeholder="Your Id Here..." required="true"/>
            </div>

            <div class="form-group">
                <label for="id" class="font">Password: </label>
              <input type="password" class="form-control" name="password" id="password"  placeholder="Your Password Here..." required="true"/>
            </div>

            <div class="form-group ">
              <button type="submit" class="btn btn-lg btn-warning btn-block">Login</button>
            </div>
            <a href="register.php">Don't Have an Account? Register Here!!</a>
          </form>
        </div>
      </div>
      </div>
      <div class="col-md-4 col-xs-1 col-sm-1 col-lg-4">
           
      </div>
      </div>
      
    </div> 
  </body>
</html>