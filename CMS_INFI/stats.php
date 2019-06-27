<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_login();?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Infiniti | Dashboard </title>
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
	<div style="height: 10px; background:#2f4050;margin-top:-20px;"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
			     <!--Side Bar -->
				 </br>
				<ul id="Side_Menu"class="nav nav-pills nav-stacked">
					<li><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp; Dashboard</a></li>
					<li class="active"><a href="stats.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Stats</a></li>
					<li><a href="addpost.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add Post</a></li>
					<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
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
				<h1>Stats Record</h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<td>Total number of posts</td>
							<td><?php
							global $conn;
							$query="Select * from posts";
							$run=mysqli_query($conn,$query);
							$Postnum=mysqli_num_rows($run);
							echo $Postnum;
							?></td>
						</tr>
						<tr>
							<td>Total number of categories</td>
							<td><?php
							global $conn;
							$query="Select * from category";
							$run=mysqli_query($conn,$query);
							$catnum=mysqli_num_rows($run);
							echo $catnum;
							?></td>
						</tr>
						<tr>
							<td>Total number of Users</td>
							<td><?php
							global $conn;
							$query="Select * from adminreg";
							$run=mysqli_query($conn,$query);
							$adminnum=mysqli_num_rows($run);
							echo $adminnum;
							?></td>
						</tr>
						<tr>
							<td>Total number of comments</td>
							<td><?php
							global $conn;
							$query="Select * from comments";
							$run=mysqli_query($conn,$query);
							$cmntnum=mysqli_num_rows($run);
							echo $cmntnum;
							?></td>
						</tr>
						<tr>
							<td>Total number of Approved Comments</td>
							<td><?php
							global $conn;
							$query="Select * from comments where status='ON'";
							$run=mysqli_query($conn,$query);
							$scmntnum=mysqli_num_rows($run);
							echo $scmntnum;
							?></td>
						</tr>
						<tr>
							<td>Total number of Un-Approved Comments</td>
							<td><?php
							global $conn;
							$query="Select * from comments where status='OFF'";
							$run=mysqli_query($conn,$query);
							$ncmntnum=mysqli_num_rows($run);
							echo $ncmntnum;
							?></td>
						</tr>
					</table>
				</div>
				
				
				<!--Main Page end-->
			</div>
			<!--row end -->
		</div>
	
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