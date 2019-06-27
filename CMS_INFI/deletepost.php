<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_login();?>
<?php
if(isset($_POST["submit"])){
	$title=($_POST["Title_name"]);
	$category=($_POST["Category"]);
	$content=($_POST["post"]);
	$tag1=($_POST["Title_tag1"]);
	$tag2=($_POST["Title_tag2"]);
	$tag3=($_POST["Title_tag3"]);
	$tag4=($_POST["Title_tag4"]);	
	$CurrentTime=time();
	$DateTime=strftime("%B-%D-%Y %H:%M:%S",$CurrentTime);
	$DateTime;
	$Admin="majeed";
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
		$searchpara=$_GET['delete'];
		$query="delete from posts where id='$searchpara'";
		$execute=mysqli_query($conn,$query);
		move_uploaded_file($_FILES["image"]["tmp_name"],$target);
		if($execute){
			$_SESSION["successMessage"]="Post deleted succesfully";
			redirect_to("dashboard.php");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong";
			redirect_to("editpost.php");
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Infiniti | Delete Post </title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/jquery-3.4.1.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="css/adminpagestyle.css">
	</head>
	<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
			     <!--Side Bar -->
				</br>
				</br>
				<ul id="Side_Menu"class="nav nav-pills nav-stacked">
					<li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;&nbsp; Dashboard</a></li>
					<li ><a href="addpost.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;Add Post</a></li>
					<li ><a href="#"><span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Categories</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Comments</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;&nbsp;Live Blog</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Manage Admins</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li>
				</ul>
				<!--Side Bar end -->
			</div>
			
			
			<div class="col-sm-10">
				<!--Main Page -->
				<h1>DELETE POSTS</h1>
				<div><?php echo Message(); echo successMessage();?></div>
				<div>
				<?php
					$searchparam=$_GET['delete'];
					$conn;
					$query="Select * from posts where id='$searchparam'";
					$run=mysqli_query($conn,$query);
					while($Datarows=mysqli_fetch_array($run)){
						$titletoupdate=$Datarows["title"];
						$categorytoupdate=$Datarows["category"];
						$imagetoupdate=$Datarows["photos"];
						$contenttoupdate=$Datarows["content"];
						$tag1toupdate=$Datarows["tag1"];
						$tag2toupdate=$Datarows["tag2"];
						$tag3toupdate=$Datarows["tag3"];
						$tag4toupdate=$Datarows["tag4"];
					}
					
				?>
				<form action="deletepost.php?delete=<?php echo $searchparam;  ?>" method="post" enctype="multipart/form-data">
				  <fieldset>
				  <div class="form-group">
					<label for="title_name">Title:</label>
					<input  value="<?php echo $titletoupdate;?>" class="form-control" type="text" name="Title_name" id="title_name" placeholder="Name">
				  </div>
				  <div class="form-group">
				  <span class="field_info">Existing Category:</span>
				  <?php echo $categorytoupdate; ?>
				  </br>
					<label for="Category_select"><span class="field_info">Category:</span></label>
					<select disabled class="form-control" id="Category_select" name="Category">
						<?php
					
					global $conn;
					$viewquery="Select * from category";
					$run=mysqli_query($conn,$viewquery);
					while($Datarows=mysqli_fetch_array($run)){
						$id=$Datarows["id"];
						$Categoryname=$Datarows["name"];
				
						?>
					<option> <?php echo $Datarows["name"];?></option>
					<?php } ?>
					</select>
				  </div>
				  <div class="form-group">
					<span class="field_info">Existing image:</span>
					<img  src="Uploads/<?php echo $imagetoupdate; ?>" width="170px" height="50px">
					</br>
					<label for="title_image">Select Image:</label>
					<input disabled class="form-control" type="file" name="image" id="title_image">
				  </div>
				  <div class="form-group">
				  <label for="title_post">Content:</label>
				  <textarea disabled class="form-control" name="post" id="title_post"> <?php echo $contenttoupdate;?> </textarea>
				  </div>
				  <div class="form-group">
					<label for="title_tag1">Tag1:</label>
					<input disabled value="<?php echo $tag1toupdate;?>" class="form-control" type="text" name="Title_tag1" id="title_tag1" placeholder="TAGS">
					<label for="title_tag2">Tag2:</label>
					<input disabled value="<?php echo $tag2toupdate;?>" class="form-control" type="text" name="Title_tag2" id="title_tag2" placeholder="TAGS">
					<label for="title_tag3">Tag3:</label>
					<input disabled value="<?php echo $tag3toupdate;?>" class="form-control" type="text" name="Title_tag3" id="title_tag3" placeholder="TAGS">
					<label for="title_tag4">Tag4:</label>
					<input disabled value="<?php echo $tag4toupdate;?>" class="form-control" type="text" name="Title_tag4" id="title_tag4" placeholder="TAGS">
				  
				  </div>
				  </br>
				  </br>
				  </br>
				     <input class="btn btn-danger btn-block" type="submit" name="submit" value="Delete Post">
				  
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