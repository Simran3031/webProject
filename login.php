<?php 
require_once("connection.php");
require_once("header.php");
?>


<style type="text/css">
	#form 
{
   padding:2rem;
   margin: auto;
   max-width: 30rem;
   background: #C9D6FF;  /* fallback for old browsers 
   background: -webkit-linear-gradient(to top, #E2E2E2, #C9D6FF);  /* Chrome 10-25, Safari 5.1-6 */
   background: linear-gradient(to top, #E2E2E2, #C9D6FF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}


.row 
{
   margin: auto;
   width: 50%;
   margin-top: 50px;
}

#signupForm
{
	width: 90%;
	margin: auto;
	padding: 30px;
}

#signupForm div
{
	margin-bottom:10px;
}
</style>

<section id="form">
	<form class="row g-3 col-md-8 " id="loginForm" action="signup-and-login-process.php" method="post">
		<h1>User Login</h1>
		<div class="col-md-12">
			<label for="emailLogin" class="form-label">Email</label>
			<input type="email" class="form-control" id="emailLogin" name="emailLogin">
		</div>
		<div class="col-md-12">
			<label for="inputPassword4" class="form-label">Password</label>
			<input type="password" class="form-control" id="inputPassword4" name="passwordLogin">
		</div>
		
		
		
		<div class="col-12">
			<input type="submit" class="btn btn-primary" name="login" value="LogIn">
		</div>
	</form>

	<!-- Button trigger modal -->
	
	<p>Do not have an account with us yet?
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">
	  Sign Up
	</button>
	</p>

</section>

	<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">User SignUp</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="signup-and-login-process.php" id="signupForm" method="post" enctype='multipart/form-data'>
      <fieldset>
        <div class="col-md-12">
			<label for="firstname" class="form-label">First Name</label>
			<input type="text" class="form-control" id="firstname" name="firstname" >
			
		</div>
		  <div class="col-md-12">
			<label for="lastname" class="form-label">Last Name</label>
			<input type="text" class="form-control" id="lastname" name="lastname" >
			
		</div>
		<div class="col-md-12">
			<label for="email" class="form-label">Email</label>
			<input type="email" class="form-control" id="email" name="email">
			
		</div>
		<div class="col-md-12">
			<label for="password" class="form-label">Password</label>
			<input type="text" class="form-control" id="password" name="password" >
			
		</div>
		
		<div class="col-md-12">
			<label for="inputPassword4" class="form-label">Renter Password</label>
			<input type="password" class="form-control" id="inputPassword4" name="passwordLoginRenter">
			
		</div>
		<div class="col-md-12">
  <label for="formFile" class="form-label">Profile picture</label>
  <input class="form-control" type="file"  name="image" id="image">
</div>
		<fieldset class="row mb-3">
	 <legend class="col-form-label col-sm-2 pt-0">User</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="user" id="adminRadio" value="0">
        <label class="form-check-label" for="adminRadio">
          Admin
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="user" id="visitorRadio" value="1" checked>
        <label class="form-check-label" for="visitorRadio">
          Visitor
        </label>
      </div>
    </div>
  </fieldset>
        <input type="submit" class="btn btn-primary" name="signup" value="SignUp">
    
   </fieldset>
</form>
    </div>
  </div>
</div>

<?php 
require("footer.php");
?>
