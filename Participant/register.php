<!DOCTYPE html>
<!--Abhay-->
<html>
<head>
  <title>
     Register
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
        <div style="align-content:center;">
            <img src="../img/event.png" style="height:60%; width:60%; border-radius:2%; display:block; margin-left:auto; margin-right:auto;">
        </div>
        <div class="main-login main-center">
            <form class="form-horizontal" method="post" action="reghandler.php">
                    <div class="main-login main-center">
                        <?php if(isset($_GET['loginFailed'])){ ?><div class="alert alert-danger" role="alert"> <?php echo "Registration Failed"; ?> </div><?php } ?>
                            <br>
                        <div class="form-group">
                            <label for="id" class="font">User name: </label>
                            <input type="id" class="form-control" name="name" id="name"  placeholder="Enter name" required='true'/>
                        </div>
                        <div class="form-group">
                            <label for="id" class="font">Password: </label>
                            <input type="password" class="form-control" name="password" id="password"  placeholder="Enter Password" required='true'/>
                        </div>

                        

                        <div class="form-group">
                            <label for="id" class="font">Phone: </label>
                            <input type="number" min="100000000" max="9999999999" class="form-control" name="phnum" id="phnum"  placeholder="Enter phone-number" required="true"/>
                        </div>
                        <div class="form-group">
                            <label for="id" class="font">Email: </label>
                            <input type="email" class="form-control" name="email" id="email"  placeholder="Enter email" required='true'/>
                        </div>
                        <div class="form-group">
                            <label for="id" class="font">City: </label>
                            <input type="id" class="form-control" name="city" id="city"  placeholder="Enter City" required='true'/>
                        </div>
                         <div class="form-group">
                            <label for="id" class="font">Date Of Birth: </label>
                            <input type="date" class="form-control" name="dob" id="dob"  placeholder="Enter DoB" required='true'/>
                        </div>
                        <div class="form-group">
                            <label for="id" class="font">Organisation </label>
                            <input type="id" class="form-control" name="org" id="org"  placeholder="Enter Organisation" required='true'/>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-warning btn-lg btn-block login-button">Register</button>
                        </div>
                    </div>
                     <a href="login.php">Have an Account? Login Here!!</a>
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