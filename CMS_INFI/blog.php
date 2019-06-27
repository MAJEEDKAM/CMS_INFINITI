<?php require_once("includes/config.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php require_once("includes/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>Infiniti | BLOG </title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <script src="js/jquery-3.4.1.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="css/publicpagestyle.css">
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
			<ul class="nav navbar-nav">
			<?php
			
			$conn;
			$query="select * from category";
			$run=mysqli_query($conn,$query);
			while($row=mysqli_fetch_assoc($run)){
				$category=$row['name'];
				echo "<li><a href='blog.php?category={$category}'>$category</a></li>";
			}
			?>
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
		</div>
		<div class="row">
		<!--Main Page -->
			<div class="col-sm-8"><!--left side -->
			</br>
			</br>
			</br>
			</br>
			<?php
			global $conn;
			if(isset($_GET["searchbutton"])){
				$search=$_GET["search"];
				$Viewquery="Select * from posts Where dateTime like '%$search%' or
				title like '%$search%' or category like '%$search%' or content like '%$search%' 
				or tag1 like '%$search%' or tag2 like '%$search%' or tag3 like '%$search%' or tag4 like '%$search%'";
			}
			elseif(isset($_GET["category"])){
				$Category=$_GET["category"];
				$Viewquery="select * from posts Where category ='$Category' order by dateTime desc";
			}
			elseif(isset($_GET["tag"])){
				$tag=$_GET["tag"];
				$Viewquery="select * from posts Where tag1 ='$tag'";
			}
			elseif(isset($_GET["page"])){
				$page=$_GET["page"];
				if($page==0 ||$page<0 ){
					$showpostfrom=0;
				}else{
				$showpostfrom=($page*5)-5;
				}
				$Viewquery="Select * from posts order by dateTime desc limit $showpostfrom,5";
			}
			else{
			$Viewquery="Select * from posts order by dateTime desc limit 0,5";}
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
				<div class="thumbnail well">
					<img class="img-responsive img-rounded" src="Uploads/<?php echo $image; ?> ">
					<div class="caption">
						<h1 id="postheading"><?php echo htmlentities($title); ?></h1>
						<p><b>Category:</b><?php echo htmlentities($Category); ?> <b>Published on:</b><?php echo htmlentities($dateTime); ?></p>
						<p><b>Tags:</b><span style="color:blue"><?php echo htmlentities($tag1); ?>&nbsp;&nbsp; <?php echo htmlentities($tag2); ?>&nbsp;&nbsp; <?php echo htmlentities($tag3); ?>&nbsp;&nbsp; <?php echo htmlentities($tag4); ?>&nbsp;&nbsp; </span></p>
						<p class="content"><?php 
						if(strlen($content)>100){
							$content=substr($content,0,150).'....';
						
						echo $content; ?></p>
						<a href="fullpost.php?id=<?php echo $DataRows['id']; ?>"><span class="btn btn-info pull-right" id="readmorebtn">Read More >></span></a>
						<?php }else{
							echo $content;
						}?>
					</div>
					</br>
				</br>
				</div></br></br>
			<?php } ?>
			<nav>
				<ul class="pagination pull-left pagination-lg">
			<?php
				if(isset($page)){
			if($page>1){
				?>
				<li><a href="blog.php?page=<?php echo $page-1; ?>"><<</a></li>
			
				<?php }	}?>
			
			
			<?php
			global $conn;
			$querycnt="select count(*) from posts";
			$run=mysqli_query($conn,$querycnt);
			$rowpage=mysqli_fetch_array($run);
			$totpost=array_shift($rowpage);
			$postpage=$totpost/5;
			$postpage=ceil($postpage);
			
			for($i=1;$i<=$postpage;$i++){
				if(isset($page)){
				
				if($i==$page){
			?>
						
			<li class="active"><a href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php }else{?>
					<li><a href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php }
			}} ?>
			<?php
				if(isset($page)){
			if($page+1<= $postpage){
				?>
				<li><a href="blog.php?page=<?php echo $page+1; ?>">>></a></li>
			
				<?php }	}?>
			</ul>
			</nav>
			</br></br></br>
			</div><!--left side end-->
			
			<div class="col-sm-offset-1 col-sm-3 "><!--right side -->
				</br>
				</br>
				</br>
				</br>
				</br>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">Recent Tags</h2>
					</div>
					<div class="panel-body">
						<?php
						global $conn;
						$Viewquery = "select id,tag1,tag2,tag3,tag4 from posts order by datetime desc";
						$run=mysqli_query($conn,$Viewquery);
						while($DataRows=mysqli_fetch_array($run)){
							$id=$DataRows['id'];
							$tag1=$DataRows['tag1'];
						
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
				</div>
			</div><!--right side end-->
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
 
 