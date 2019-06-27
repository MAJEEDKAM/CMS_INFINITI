<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
if(isset($_POST["submit"])){
	$name=($_POST["Name"]);
	$Email=($_POST["Email"]);
	$comment=($_POST["comment"]);
	$CurrentTime=time();
	$DateTime=strftime("%B-%D-%Y %H:%M:%S",$CurrentTime);
	$DateTime;
	$postid=$_GET["id"];
	if(empty($Email)){
		$_SESSION["ErrorMessage"]="All Fields Required";
		redirect_to("fullpost.php?id={$postid}");
	}elseif(strlen($comment)>500){
		$_SESSION["ErrorMessage"]="Too long comment keep it uder 500 words";
		redirect_to("fullpost.php?id={$postid}");
	}else{
		global $conn;
		$commquery="Insert into comments(datetime,name,email,comments,status,post_id)
		values('$DateTime','$name','$Email','$comment','OFF','$postid')";
		$run=mysqli_query($conn,$commquery);
		if($run){
			$_SESSION["successMessage"]="comment Added succesfully";
			redirect_to("fullpost.php?id={$postid}");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong";
			redirect_to("fullpost.php?id={$postid}");
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Infiniti | POST </title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/jquery-3.4.1.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="css/publicpagestyle.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
	<div style="height: 10px; background:black;"></div>
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
			<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav pull-right">
				<li><a href="signup.php">Signup/Login</a></li>
			</ul>
			<form action="blog.php" class="navbar-form pull-right">
				<div class="form-group">
				<input type="text" class="form-control" placeholder="Search" name="search">
				</div>
				<button class="btn btn-success" name="searchbutton">Go</button>
			</form>
			</div>
		</div>
	</nav>
	<div style="height: 10px; background:black;margin-top:-20px;"></div>	
	<div class="container">
		<!--Conatainer -->
		<div class="blog-header">
		</br>
		</br>
		</br>
		</div>
		<div class="row">
		<!--Main Page -->
			<div class="col-sm-8 "><!--left side -->
			<div class="well">
			<div><?php echo Message(); echo successMessage();?></div>
			<?php
			 $conn;
			if(isset($_GET["searchbutton"])){
				$search=$_GET["search"];
				$Viewquery="Select * from posts Where dateTime like '%$search%' or
				title like '%$search%' or category like '%$search%' or content like '%$search%' 
				or tag1 like '%$search%' or tag2 like '%$search%' or tag3 like '%$search%' or tag4 like '%$search%'";
			}else{
				$postid=$_GET["id"];
			$Viewquery="Select * from posts where id='$postid' order by datetime desc";}
			$run=mysqli_query($conn,$Viewquery);
			while($DataRows=mysqli_fetch_array($run)){
				$postid=$DataRows["id"];
				$dateTime=$DataRows["dateTime"];
				$title=$DataRows["title"];
				$Category=$DataRows["category"];
				$content=$DataRows["content"];
				$image=$DataRows["photos"];
				$author=$DataRows["Author"];
				$tag1=$DataRows["tag1"];
				$tag2=$DataRows["tag2"];
				$tag3=$DataRows["tag3"];
				$tag4=$DataRows["tag4"];
			?>
				<div class="thumbnail">
					<img class="img-responsive img-rounded" src="Uploads/<?php echo $image; ?> ">
					<div class="caption">
						<h1 id="postheading"><?php echo htmlentities($title); ?></h1>
						<p><b>Category:</b><?php echo htmlentities($Category); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Published on:</b><?php echo htmlentities($dateTime); ?></p>
						<p><b>Tags:</b><?php echo htmlentities($tag1); ?>&nbsp;&nbsp;&nbsp; <?php echo htmlentities($tag2); ?>&nbsp;&nbsp; <?php echo htmlentities($tag3); ?>&nbsp;&nbsp; <?php echo htmlentities($tag4); ?>&nbsp;&nbsp; </p>
						<p class="content"><?php 
						echo nl2br($content); ?></p>
					</div>
					</br>
				</br>
				</div>
				<div style="size:large;" class="pull-right">Share the post now:
					<a href="https://www.facebook.com/" class="fa fa-facebook"></a>&nbsp;&nbsp;
					<a href="#" class="fa fa-twitter"></a>&nbsp;&nbsp;
					<a href="#" class="fa fa-google"></a>&nbsp;&nbsp;
					<a href="#" class="fa fa-linkedin"></a>&nbsp;&nbsp;
					<a href="#" class="fa fa-youtube"></a>&nbsp;&nbsp;
					<a href="#" class="fa fa-instagram"></a>
				</div>
				</br></br></br>
				</div>
			<?php } ?>
				<h3><u>Comments:</u></h3>
				<?php
					$Conn;
					$postidcomm=$_GET["id"];
					$commentquery="Select * from comments where post_id='$postidcomm' and status='on'";
					$run=mysqli_query($conn,$commentquery);
					while($DataRows=mysqli_fetch_array($run)){
						$commentdate=$DataRows["datetime"];
						$commentname=$DataRows["name"];
						$commentpost=$DataRows["comments"];
				
				?>
				<div class="commentblock">
					<img class="pull-left" src="images/prof.png" width="50px" height="70px">
					<p><?php echo $commentname;?></p>
					<p><?php echo $commentdate;?></p>
					<p><?php echo nl2br($commentpost);?></p>
					
				</div>
				</br>
					<hr>
					<?php } ?>
				<h3><u>Share your comments here:</u></h3>
				<div class="well">
				<form action="fullpost.php?id=<?php echo $postid;?>" method="post" enctype="multipart/form-data">
				  <fieldset>
				  <div class="form-group">
					<label for="title_name">Name:</label>
					<input class="form-control" type="text" name="Name" id="namec" placeholder="Name">
				  </div>
				  <div class="form-group">
					<label for="title_name">Email:</label>
					<input class="form-control" type="email" name="Email" id="email" placeholder="Email">
				  </div>
				  <div class="form-group">
				  <label for="title_post">Comment:</label>
				  <textarea class="form-control" name="comment" id="comment"></textarea>
				  </div>
			
				  </br>
				  </br>
				  </br>
				     <input class="btn btn-success btn-block" type="submit" name="submit" value="submit">
				  
				  </br>
				  </br>
				  </br>
				  </fieldset>
				</form>
				</br>
				</div>
				
			</div><!--left side end-->
			
			<div class="col-sm-offset-1 col-sm-3 "><!--right side -->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Recent Tags</h2>
					</div>
					<div class="panel-body">
						<?php
						global $conn;
						$Viewquery = "select id,tag1,tag2,tag3,tag4 from posts order by datetime desc limit 0,7";
						$run=mysqli_query($conn,$Viewquery);
						while($DataRows=mysqli_fetch_array($run)){
							$id=$DataRows['id'];
							$tag1=$DataRows['tag1'];
							$tag2=$DataRows['tag2'];
							$tag3=$DataRows['tag3'];
							$tag4=$DataRows['tag4'];
						
						?>
						<a href="blog.php?tag=<?php echo $tag1; ?>">
						<span style="color:blue;"><b><?php echo $tag1."&nbsp;&nbsp;&nbsp;"?></b></span>
						</a>
						<?php } ?>
					</div>
					<div class="panel-footer">
				
					</div>
				</div>
				</br>
				</br>
				</br>
				
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Recent Posts</h2>
					</div>
					<div class="panel-body">
					<?php 
						$conn;
						$Viewquery="select * from posts order by datetime desc limit 0,5";
						$run=mysqli_query($conn,$Viewquery);
						while($DataRows=mysqli_fetch_array($run)){
							$id=$DataRows["id"];
							$title=$DataRows["title"];
							$date=$DataRows["dateTime"];
							$img=$DataRows["photos"];
							if(strlen($date)>10){$date=substr($date,5,13);}
					
					?>
						<div>
							<img class="pull-left" style="margin-top:10px;margin-left:10px;"src="Uploads/<?php echo $img;?>" width="70px" height="70px">
							<a href="fullpost.php?id=<?php echo $id;?>">
							<p style="color:blue;font-family:Times New Roman;font-size:15px;margin-left:90px;"><?php echo $title;?></p>
							</a>
							<p style="margin-left:90px;color:gray;"><?php echo $date;?></p>
							<hr>
						</div>
					
						<?php } ?>
					</div>
					<div class="panel-footer">
				
					</div>
				</div></div><!--right side end-->
		</div><!--Main Page end -->
	
	</div><!--Conatiner End -->
	
	<div id="footer">
		<!-- Footer -->
		<footer class="page-footer font-small blue">
		  <div class="footer-copyright text-right well" style=""><b>© 2019 Copyright:Infiniti Software Solutions.com</b>&nbsp;&nbsp;&nbsp;
		  </div>
		</footer>
	</div><!-- Footer end -->
	
	</body>
</html>
 
 