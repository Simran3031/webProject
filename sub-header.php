<!-- <style type="text/css">
	
#profile_picture
{
   height: 50px;
   width: 50px;
   border-radius: 50%;
   margin-right: 10px;
}

</style> -->
<!-- <?php 
	// $user_id = $_SESSION["user_id"];
	// $query = "SELECT * FROM users WHERE user_id = :user_id "; 
 //    $statement = $db->prepare($query);
 //    $statement->bindValue(':user_id', $user_id);
 //    $statement->execute();
 //        $user= $statement->fetch();
 //        $image = $user["profile_picture"];
?> -->

<nav class="navbar navbar-expand-lg dashboard-nav col-md-11">
		<div class="container-fluid d-flex">

			<p>Welcome <?php echo $_SESSION["email"];   ?></p>
			
				
				
		<form class="d-flex justify-content-end" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
			
		</div>
	</nav>