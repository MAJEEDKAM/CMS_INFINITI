<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if(isset($_GET["id"])){
	$idurl=$_GET["id"];
	$conn;
	$query="UPDATE comments set status='OFF' where id='$idurl'";
	$run=mysqli_query($conn,$query);
	if($run){
			$_SESSION["successMessage"]="comment dis-approved succesfully";
			redirect_to("comments.php");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong";
			redirect_to("comments.php");
		}
	
	
}
?>