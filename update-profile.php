<?php 
require_once("connection.php");
require_once("header.php");
//Image is optional
	$user_id = $_SESSION["user_id"];
	$query = "SELECT * FROM users WHERE user_id = :user_id "; 
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $user= $statement->fetch();
    $image = $user["profile_picture"];
?>
<style type="text/css">
	
#profile_picture
{
   height: 50px;
   width: 50px;
   border-radius: 50%;
   margin-right: 10px;
}

#sub-nav
{
	margin: auto;
	width: 90%;
}

#updateForm, #passwordForm
{
	margin: auto;
	width: 70%;
}
#passwordForm label
{
	margin-top: 15px;
}

#changePassword
{
	margin: 20px 0px;
}


</style>
<nav class="navbar navbar-expand-lg dashboard-nav col-md-11" id="sub-nav" >
		<div class="container-fluid d-flex">

			<p>Welcome <?php echo $_SESSION["email"];   ?></p>
			<button type="button" class="btn btn-success justify-content-end" data-bs-toggle="modal" data-bs-target="#passwordModal">
	  Change Password
	</button>
		</div>
</nav>
<section>
	<form action="signup-and-login-process.php" id="updateForm" method="post" enctype='multipart/form-data'>
		<h1>Update your data</h1>
      <fieldset class="row g-3">

      		 <div class="col-md-6">
			<label for="firstname" class="form-label">First Name</label>
			<input type="text" class="form-control" id="firstname" name="firstname" value="<?= $user["firstname"] ?>">
			
		</div>
		  <div class="col-md-6">
			<label for="lastname" class="form-label">Last Name</label>
			<input type="text" class="form-control" id="lastname" name="lastname" value="<?= $user["lastname"] ?>">
			
		</div>

       
		<div class="col-md-12">
			<label for="email" class="form-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" value="<?= $user["email"] ?>" disabled>
			
		</div>
		
	<div class="col-md-4">
		<?php if($user["profile_picture"] != null): ?>
	<p>Your current profile picture-<?= $user["profile_picture"] ?></p>
  <img src="uploads\<?= $user["profile_picture"] ?>" alt="profile_picture" style="height: 280px;width: 200px">

  <p><input type="checkbox" name="check"> Check if you wish to delete your picture!</p>
  <?php else: ?>
  <p>You do not have a profile picture uploaded!</p>
<?php endif; ?>

</div>
		<div class="col-md-8">
  <label for="formFile" class="form-label">Choose if you want to update your profile picture:</label>
  <input class="form-control" type="file"  name="image" id="image">
  
</div>

		<div>
        <input type="submit" class="btn btn-primary col-md-1" name="update" value="Update">
     </div>

    
   </fieldset>
</form>
</section>

<!-- Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="signup-and-login-process.php" id="passwordForm" method="post">
      <fieldset>
        
        <div class="col-md-12">
			<label for="password" class="form-label">Current Password</label>
			<input type="password" class="form-control" id="currentPassword" name="currentPassword" >
			
		</div>

		<div class="col-md-12">
			<label for="password" class="form-label">New Password</label>
			<input type="password" class="form-control" id="newPassword" name="newPassword" >
			
		</div>
		
		<div class="col-md-12">
			<label for="inputPassword4" class="form-label">Renter Password</label>
			<input type="password" class="form-control" id="renterPassword" name="renterPassword">
			
		</div>
		
        <input type="submit" class="btn btn-primary" name="changePassword" id= "changePassword" value="Change Password">
    
   </fieldset>
</form>
    </div>
  </div>
</div>


<?php
require_once("footer.php"); 
?>

