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
			width: 400px;
					}
		.card-img-top
		{
			height: 280px;
			width: 100%;
		}

		.dashboard-nav
		{
			margin: auto;
			width: 90%;
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
					<h1 class="card-title">Get your questions answered!</h1>
					<p class="card-text">We are here to help! Ask us anything and everyting. We try to get you information that is true and could be relied upon.</p>
					<a href="questions.php" class="btn btn-success">Go to questions</a>
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
	</div>


<?php
require_once("footer.php"); 
?>
