<?php 
require_once("connection.php");
require_once("header.php");
?>


<style type="text/css">

		.row 
		{
			width: 50%;
			margin: auto;
			margin-top: 3vh;
			margin-bottom: 120px;

		}

		.card
		{
			border: 1px solid grey;
			width: 350px;
		
		}

		.card-img-top
		{
			height: 280px;
			width: 100%;
		}

		.dashboard-nav
		{
			
			width: 90%;
			margin: auto;
		}
		.col
		{
			margin-top: 20px;
		}
	</style>


	<nav class="navbar navbar-expand-lg dashboard-nav">
		<div class="container-fluid d-flex">
			<p>Welcome <?php echo $_SESSION["email"];   ?></p>

		</div>
	</nav>
	
	<div class="row">
		<div class="col">
			<div class="card h-100">
				<img src="images/questions.png" class="card-img-top" alt="questions">
				<div class="card-body">
					<h1 class="card-title">Users</h1>
					<p class="card-text">View, add, update and delete users of your website.</p>
					<a href="users.php" class="btn btn-success">View Users</a>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card h-100">
				<img src="images/questions.jpg" class="card-img-top" alt="...">
				<div class="card-body">
					<h1 class="card-title">View all Questions</h1>
					<p class="card-text">View, add, update and delete questionsa asked.</p>
					<a href="view-questions.php" class="btn btn-success">View Questions</a>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card h-100">
				<img src="images/profile.png" class="card-img-top" alt="...">
				<div class="card-body">
					<h1 class="card-title">Update your profile</h1>
					<p class="card-text">Want to cahnge your data? Click Here!</p>
					<a href="update-profile.php" class="btn btn-success">Update Profile</a>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card h-100">
				<img src="images/comments.png" class="card-img-top" alt="...">
				<div class="card-body">
					<h1 class="card-title">View Comments</h1>
					<p class="card-text">View and delete comments</p>
					<a href="view-comments.php" class="btn btn-success">View comments</a>
				</div>
			</div>
		</div>
	</div>


<?php
require_once("footer.php"); 
?>
