 <?php 
require_once("connection.php");
require_once("header.php");

$query= "SELECT * FROM users ORDER BY user_id DESC";
$statement = $db->prepare($query);
$statement->execute();


?>

<style type="text/css">
	
.table
{

   width: 80%;
   margin: auto;
   margin-top: 2rem;
}

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
	
	<nav class="navbar navbar-expand-lg dashboard-nav col-md-11">
		<div class="container-fluid d-flex">

			<p>Welcome <?php echo $_SESSION["email"]; ?></p>
	
			<button type="button" class="btn btn-success justify-content-end" data-bs-toggle="modal" data-bs-target="#signupModal">
	  Create new User
	</button>
		</div>
	</nav>

	<div class="tableDiv">
		<table class="table table-success table-striped table-responsive table-bordered">
  <thead>
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th colspan="2" >Profile Picture</th>
    </tr>
  </thead>
  <tbody>
		<?php while ($user = $statement->fetch()): ?>
			<tr>
      <th scope="row"><?= $user["user_id"] ?></th>
      <td><?= $user["firstname"] ?></td>
      <td><?= $user["lastname"] ?></td>
      <td><?= $user["email"] ?></td>
      <?php if($user["user_role"] == 0): ?>
        <td>Admin</td>
      <?php else: ?>
      	<td>Visitor</td>
       <?php endif; ?>
      <td><?= $user["profile_picture"] ?></td>
      <td><a href="editUser.php?user_id=<?= $user['user_id'] ?>" >-edit</a></td>
    </tr>
     

		<?php endwhile; ?> 
			
		</tbody>
	</table>
		</div>


<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">Create User</h1>
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
        <input type="submit" class="btn btn-primary" name="create" value="Create">
    
   </fieldset>
</form>
    </div>
  </div>
</div>

<?php
require_once("footer.php"); 
?>
