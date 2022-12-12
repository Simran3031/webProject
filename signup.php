
<?php include("header.php") ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Portal for International Students</title>

	<!-- font awesome link -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

	<!-- bootstrap link -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css">

	<!-- custom css file -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">

	<!-- bootstrap js file -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</head>
<body>
<section class="form" id="signupForm">

 <form action="signup-process.php" method="post">
 	<div class="col-md-4">
			<label for="firstname" class="form-label">First Name</label>
			<input class="form-control" id="firstname" name="firstname" >
			<br>
		</div>
	 <div class="col-md-4">
			<label for="lastname" class="form-label">Last Name</label>
			<input class="form-control" id="lastname" name="lastname" >
			<br>
		</div>


		<div class="col-md-4">
			<label for="email" class="form-label">Email</label>
			<input type="email" class="form-control" id="email" name="email">
			<br>
		</div>
		<div class="col-md-4">
			<label for="password" class="form-label">Password</label>
			<input type="text" class="form-control" id="password" name="password" >
			<br>
		</div>
		<fieldset class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">User</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="user" id="adminRadio" value="admin" checked>
        <label class="form-check-label" for="user">
          Admin
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="user" id="visitorRadio" value="visitor">
        <label class="form-check-label" for="user">
          Visitor
        </label>
      </div>
    </div>
  </fieldset>
        <input type="submit" class="btn btn-primary" name="signup" value="SignUp">
 </form>
</section>

  





	<!-- 	
		<fieldset class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">User</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="user" id="adminRadio" value="admin" checked>
        <label class="form-check-label" for="user">
          Admin
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="user" id="visitorRadio" value="visitor">
        <label class="form-check-label" for="user">
          Visitor
        </label>
      </div>
    </div>
  </fieldset> -->














	<!-- custom javascript file -->
	<script type="text/javascript" src="js/script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>