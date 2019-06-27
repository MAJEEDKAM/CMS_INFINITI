<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_login();?>
<?php
if(isset($_POST["submit"])){
	$title=($_POST["Title_name"]);
	$category=($_POST["Category"]);
	$content=($_POST["Title_post"]);
	$tag1=($_POST["Title_tag1"]);
	$tag2=($_POST["Title_tag2"]);
	$tag3=($_POST["Title_tag3"]);
	$tag4=($_POST["Title_tag4"]);	
	$CurrentTime=time();
	$DateTime=strftime("%B-%D-%Y %H:%M:%S",$CurrentTime);
	$DateTime;
	$Admin=$_SESSION["user_name"];
	$Status="published";
	$image=$_FILES["image"]['name'];
	$target="Uploads/".basename($_FILES["image"]['name']);
	if(empty($title)){
		$_SESSION["ErrorMessage"]="All Fields Required";
		redirect_to("addpost.php");
	}elseif(strlen($title)<5){
		$_SESSION["ErrorMessage"]="Too Short Name";
		redirect_to("addpost.php");
	}else{
		global $conn;
		$query="insert into posts(datetime,title,Author,category,content,photos,Status,tag1,tag2,tag3,tag4)
		values('$DateTime','$title','$Admin','$category','$content','$image','$Status','$tag1','$tag2','$tag3','$tag4')";
		$run=mysqli_query($conn,$query);
		move_uploaded_file($_FILES["image"]["tmp_name"],$target);
		if($run){
			$_SESSION["successMessage"]="Post Added succesfully";
			redirect_to("addpost.php");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong";
			redirect_to("addpost.php");
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Infiniti | New Post </title>
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
					<li class="active"><a href="addpost.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add Post</a></li>
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
				<h1>ADD POSTS</h1>
				<div><?php echo Message(); echo successMessage();?></div>
				<div>
				<form action="addpost.php" method="post" enctype="multipart/form-data">
				  <fieldset>
				  <div class="form-group">
					<label for="title_name">Title:</label>
					<input class="form-control" type="text" name="Title_name" id="title_name" placeholder="Name">
				  </div>
				  <div class="form-group">
					<label for="Category_select">Category:</label>
					<select class="form-control" id="Category_select" name="Category">
						<?php
					
					global $conn;
					$viewquery="Select * from category";
					$run=mysqli_query($conn,$viewquery);
					while($Datarows=mysqli_fetch_array($run)){
						$id=$Datarows["id"];
						$Categoryname=$Datarows["name"];
				
						?>
					<option> <?php echo $Datarows["name"];;?></option>
					<?php } ?>
					</select>
				  </div>
				  <div class="form-group">
					<label for="title_image">Select Image:</label>
					<input class="form-control" type="file" name="image" id="title_image">
				  </div>
				  <div class="form-group">
				  <label for="title_post">Content:</label>
				  <textarea class="form-control" name="Title_post" id="title_post"></textarea>
				  </div>
				  <div class="form-group">
					<label for="title_tag1">Tag1:</label>
					<input class="form-control" type="text" name="Title_tag1" id="title_tag1" placeholder="TAGS">
					<label for="title_tag2">Tag2:</label>
					<input class="form-control" type="text" name="Title_tag2" id="title_tag2" placeholder="TAGS">
					<label for="title_tag3">Tag3:</label>
					<input class="form-control" type="text" name="Title_tag3" id="title_tag3" placeholder="TAGS">
					<label for="title_tag4">Tag4:</label>
					<input class="form-control" type="text" name="Title_tag4" id="title_tag4" placeholder="TAGS">
				  
				  </div>
				  </br>
				  </br>
				  </br>
				     <input class="btn btn-success btn-block" type="submit" name="submit" value="Add Posts">
				  
				  </br>
				  </br>
				  </br>
				  </fieldset>
				</form>
				</br>
				</div>
				
				
				
				
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