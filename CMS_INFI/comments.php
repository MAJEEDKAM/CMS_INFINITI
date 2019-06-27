<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_login();?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Infiniti | comment panel </title>
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
					<li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp; Dashboard</a></li>
					<li><a href="stats.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Stats</a></li>
					<li><a href="addpost.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add Post</a></li>
					<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
					<li class="active"><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Comments
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
				<h1>Un-Approved Comments</h1>
				<div><?php echo Message(); echo successMessage();?></div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Date</th>
							<th>Comments</th>
							<th>Approve</th>
							<th>Delete</th>
							<th>Details</th>
							
						</tr>
						<?php 
						global $conn;
						$query="Select * from comments where status='OFF' order by datetime desc ";
						$run=mysqli_query($conn,$query);
						$no=0;
						while($DataRows=mysqli_fetch_array($run)){
							$comm_id=$DataRows['id'];
							$comm_time=$DataRows['datetime'];
							$comm_name=$DataRows['name'];
							$comm_post=$DataRows['comments'];
							$comm_postid=$DataRows['post_id'];
							$no++;
							if(strlen($comm_time)>10){$comm_time=substr($comm_time,0,10).'...';}
							if(strlen($comm_name)>10){$comm_name=substr($comm_name,0,10).'...';}
						?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $comm_name;?></td>
							<td><?php echo $comm_time;?></td>
							<td><?php echo $comm_post;?></td>
							<td><a href="appcmnt.php?id=<?php echo $comm_id;?>"><span class="btn btn-success">Approve</span></a></td>
							<td><a href="dltcmnt.php?id=<?php echo $comm_id;?>"><span class="btn btn-danger">Delete</span></a></td>
							<td><a href="fullpost.php?id=<?php echo $comm_postid;?>"target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
						</tr>
						<?php }?>
					</table>
				</div>
				
				<h1>Approved Comments</h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Date</th>
							<th>Comments</th>
							<th>Approved by</th>							
							<th>Dis Approve</th>
							<th>Disapprove</th>
							<th>Details</th>
							
						</tr>
						<?php 
						$admin="majeed";
						global $conn;
						$query="Select * from comments where status='ON' order by datetime desc";
						$run=mysqli_query($conn,$query);
						$no=0;
						while($DataRows=mysqli_fetch_array($run)){
							$comm_id=$DataRows['id'];
							$comm_time=$DataRows['datetime'];
							$comm_name=$DataRows['name'];
							$comm_post=$DataRows['comments'];
							$comm_postid=$DataRows['post_id'];
							$no++;
							if(strlen($comm_time)>10){$comm_time=substr($comm_time,0,10).'...';}
							if(strlen($comm_name)>10){$comm_name=substr($comm_name,0,10).'...';}
						?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $comm_name;?></td>
							<td><?php echo $comm_time;?></td>
							<td><?php echo $comm_post;?></td>
							<td><?php echo $admin;?></td>
							<td><a href="discmnt.php?id=<?php echo $comm_id;?>"><span class="btn btn-warning">Dis Approve</span></a></td>
							<td><a href="dltcmnt.php?id=<?php echo $comm_id;?>"><span class="btn btn-danger">Delete</span></a></td>
							<td><a href="fullpost.php?id=<?php echo $comm_postid;?>"target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
						</tr>
						<?php }?>
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