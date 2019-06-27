<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_login();?>
<?php
if(isset($_POST["submit"])){
	$Category=($_POST["Category"]);
	$CurrentTime=time();
	$DateTime=strftime("%B-%D-%Y %H:%M:%S",$CurrentTime);
	$DateTime;
	$Admin=$_SESSION["user_name"];
	if(empty($Category)){
		$_SESSION["ErrorMessage"]="All Fields Required";
		redirect_to("categories.php");
	}elseif(strlen($Category)>99){
		$_SESSION["ErrorMessage"]="Too Long Name";
		redirect_to("categories.php");
	}else{
		global $conn;
		$query="insert into category(datetime,name,creatorname)
		values('$DateTime','$Category','$Admin')";
		$run=mysqli_query($conn,$query);
		if($run){
			$_SESSION["successMessage"]="Category Added succesfully";
			redirect_to("categories.php");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong";
			redirect_to("categories.php");
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
	<body>
	<div style="height: 10px; background:#2f4050;"></div>
	<nav class="navbar navbar-default" role="navigation">
		<div class="conatainer">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				
				</button>
				<a class="navbar-brand" href="blog.php">
				<img style="margin-top:-10px;" src="images/logo.png" width="200px" height="40px">
				</a>				
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
			     <!--Side Bar -->
				<ul id="Side_Menu"class="nav nav-pills nav-stacked">
					<li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp; Dashboard</a></li>
					<li><a href="stats.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Stats</a></li>
					<li><a href="addpost.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add Post</a></li>
					<li class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
					<li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Comments
					<?php
									$conn;
									$queryunapprovedtag="Select count(*) from comments where status='off'";
									$rununtag=mysqli_query($conn,$queryunapprovedtag);
									$rowsarruntag=mysqli_fetch_array($rununtag);
									$rowsuntag=array_shift($rowsarruntag);
									if($rowsuntag>0){
									?>
									<span class="label pull-right label-warning">
										<?php echo $rowsuntag;?>
									</span>
									<?php }?>
					</a></li>
					<li><a href="blog.php?page=1"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;&nbsp;Live Blog</a></li>
					<li><a href="manageadmins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Manage Admins</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li>
				</ul>
				<!--Side Bar end -->
			</div>
			
			
			<div class="col-sm-10">
				<!--Main Page -->
				<h1>Manage Categories</h1>
				<div><?php echo Message(); echo successMessage();?></div>
				<div>
				<form action="categories.php" method="post">
				  <fieldset>
				  <div class="form-group">
					<label for="cat_name">Name:</label>
					<input class="form-control" type="text" name="Category" id="cat_name" placeholder="Name">
				  </div>
				     <input class="btn btn-success btn-block" type="submit" name="submit" value="Add Category">
				  </fieldset>
				</form>
				</br>
				</div>
				<!--Diaplay Table -->
				<div class="table-responsive">
				<table class="table table-hover">
				<tr>
					<th>No.</th>
					<th>Time Of Creation</th>
					<th>Category Name</th>
					<th>Author Name</th>
					<th>Delete Category</th>
				</tr>
				<?php
					global $conn;
					$viewquery="Select * from category order by datetime desc";
					$run=mysqli_query($conn,$viewquery);
					$no=0;
					while($Datarows=mysqli_fetch_array($run)){
						$id=$Datarows["id"];
						$DateTime=$Datarows["datetime"];
						$Categoryname=$Datarows["name"];
						$CreatorName=$Datarows["creatorname"];
						$no++;
						
					
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $DateTime; ?></td>
					<td><?php echo $Categoryname; ?></td>
					<td><?php echo $CreatorName; ?></td>
					<td><a href="dltcateg.php?id=<?php echo $id;?>"><span class="btn btn-danger">Delete</span></td>
				
				</tr>
					<?php } ?>
				</table>
				</div><!--Diaplay Table End-->
				
				
			</div><!--Main Page end-->
			
		</div><!--row end -->
	
	</div><!--Container end -->
	<div id="footer">
		<!-- Footer -->
		<footer class="page-footer font-small blue">
		  <div class="footer-copyright text-right well" style=""><b>© 2019 Copyright:Infiniti Software Solutions.com</b>&nbsp;&nbsp;&nbsp;
		  </div>
		</footer>
	</div><!-- Footer end -->
	</body>
</html>