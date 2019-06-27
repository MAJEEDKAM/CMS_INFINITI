<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
function redirect_to($Location){
	header("Location:".$Location);
	exit;
}

function login_attempt($name,$password){
	global $conn;
	$query="select * from adminreg where name='$name' and pass='$password'";
	$run=mysqli_query($conn,$query);
	if($admin=mysqli_fetch_assoc($run)){
		return $admin;
	}else{
		return null;
	}
}

function login(){
	if(isset($_SESSION["user_id"])){
		return true;
	}
}

function confirm_login(){
	if(!login()){
		$_SESSION["ErrorMessage"]=" Login Required";
		redirect_to("login.php");
	}
	
}





?>