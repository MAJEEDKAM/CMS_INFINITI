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
					<li class="active"><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp; Dashboard</a></li>
					<li><a href="stats.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp; Stats</a></li>
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
				<h1>Admin Dashboard</h1>
				<div><?php echo Message(); echo successMessage();?></div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No</th>
							<th>Post Title</th>
							<th>Date & Time</th>
							<th>Author</th>
							<th>Category</th>
							<th>TAGS</th>
							<th>Image</th>
							<th>Action</th>
							<th>Preview</th>
						</tr>
						<?php
							global $conn;
							$ViewQuery="Select * FROM posts order by datetime desc;";
							$run=mysqli_query($conn,$ViewQuery);
							$no=0;
							while($DataRows=mysqli_fetch_array($run)){
									$id=$DataRows["id"];
									$title=$DataRows["title"];
									$category=$DataRows["category"];
									$time=$DataRows["dateTime"];
									$author=$DataRows["Author"];
									$action=$DataRows["Status"];
									$content=$DataRows["content"];
									$image=$DataRows["photos"];
									$tag1=$DataRows["tag1"];
									$tag2=$DataRows["tag2"];
									$tag3=$DataRows["tag3"];
									$tag4=$DataRows["tag4"];
									$no++;
							
							?>
						
						<tr>
							<td><?php echo $no;?></td>
							<td><?php 
							if(strlen($title)>35){$title=substr($title,0,35).'..';}
							echo $title;?></td>
							<td><?php 
							if(strlen($time)>11){$time=substr($time,0,11).'..';}
							echo $time;?></td>
							<td><?php echo $author;?></td>
							<td><?php echo $category;?></td>
							<td style="color:blue;"><?php echo $tag1;?></br><?php echo $tag2;?></br><?php echo $tag3;?></br><?php echo $tag4;?></td>
							<td><img src="Uploads/<?php echo $image;?>" width="130px" height="50px"></td>
							<td><a href="editpost.php?edit=<?php echo $id;?>"><span class="btn btn-warning">Edit</span></a>
							<a href="deletepost.php?delete=<?php echo $id;?>"><span class="btn btn-danger">Delete</span></a></td>
							<td><a href="fullpost.php?id=<?php echo $id;?>"><span class="btn btn-primary">Live Preview</span></td>
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