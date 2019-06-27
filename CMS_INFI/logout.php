<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
$_SESSION["user_id"]=null;
session_destroy();
redirect_to("login.php");
?>