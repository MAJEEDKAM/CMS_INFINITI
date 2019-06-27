<?php
session_start();
function Message(){
	if(isset($_SESSION["ErrorMessage"])){
		$output="<div class=\"alert alert-danger\">";
		$output.=htmlentities($_SESSION["ErrorMessage"]);
		$output.="</div>";
		$_SESSION["ErrorMessage"]=null;
		return $output;
		
	}
}
function successMessage(){
	if(isset($_SESSION["successMessage"])){
		$output="<div class=\"alert alert-success\">";
		$output.=htmlentities($_SESSION["successMessage"]);
		$output.="</div>";
		$_SESSION["successMessage"]=null;
		return $output;
		
	}
}

?>