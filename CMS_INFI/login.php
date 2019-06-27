<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if(isset($_POST["submit"])){
	$name=($_POST["username"]);
	$password=($_POST["password"]);
	
	if(empty($name)||empty($password)){
		$_SESSION["ErrorMessage"]="All Fields Required";
		redirect_to("login.php");
	}
	else{
		$found_acc=login_attempt($name,$password);
		$_SESSION["user_id"]=$found_acc["id"];
		$_SESSION["user_name"]=$found_acc["name"];
		if($found_acc){
		$_SESSION["successMessage"]="Login Successfull {$_SESSION["user_name"]}";
			redirect_to("dashboard.php");
		}else{
		$_SESSION["ErrorMessage"]="Username or password is wrong";
		redirect_to("login.php");
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Infiniti | categories </title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/jquery-3.4.1.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="css/adminpagestyle.css">
	</head>
	<body style="background-color:white;">
	<div class="container-fluid">
		<div class="row">			
			
			<div class="col-sm-offset-4 col-sm-4">
				<!--Main Page --></br>
				<!--Main Page --></br>
				</br>
				</br>
				</br>
				</br>
				<h2>LOGIN HERE!!</h2>
				<div><?php echo Message(); echo successMessage();?></div>
				<div class="well">
				<form action="login.php" method="post">
				  <fieldset>
				  <div class="form-group">
				  
					<label for="cat_name">User Name:</label>
					<input class="form-control" type="text" name="username" id="username" placeholder="username">
				  </div>
				  <div class="form-group">
					<label for="cat_name">Password:</label>
					<input class="form-control" type="password" name="password" id="password" placeholder="password">
				  </div>
				  </br>
				     <input class="btn btn-primary btn-block" type="submit" name="submit" value="Add New Admins">
				  </fieldset>
				</form>
				</br>
				</div>
				<!--Diaplay Table -->
				<!--Diaplay Table End-->
				
				
			</div><!--Main Page end-->
			
		</div><!--row end -->
	
	</div><!--Container end -->
	</body>
</html>