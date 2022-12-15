 <?php 
require_once("connection.php");
require_once("header.php");


$query= "SELECT * FROM categories ORDER BY category_id DESC";
$Statement = $db->prepare($query);
$Statement->execute();



?>

<style type="text/css">
	
.table
{

   width: 50%;
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


</style>
	
	<nav class="navbar navbar-expand-lg dashboard-nav col-md-11">
		<div class="container-fluid d-flex">

			<p>Welcome <?php echo $_SESSION["email"]; ?></p>
	  <button type="button" class="btn btn-success justify-content-end" data-bs-toggle="modal" data-bs-target="#categoryModal">
     Create new Category
   </button>
		
		</div>
	</nav>
	<div class="tableDiv">
		<table class="table table-success table-striped table-responsive table-bordered">
  <thead>
    <tr>
      <th scope="col">Category ID</th>
      <th colspan="2">Category</th>
    </tr>
  </thead>
  <tbody>

<?php while ($category = $Statement->fetch()):  ?>
<tr>
      <th scope="row"><?= $category["category_id"] ?></th>
      <td><?= $category["category"] ?></td>
      <td><a href="edit-category.php?category_id=<?= $category["category_id"]  ?>" >-edit</a></td>
    </tr>
<?php endwhile; ?>


		</tbody>
	</table>
		</div>

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signupModalLabel">Create Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="edit-category-process.php" id="signupForm" method="post" enctype='multipart/form-data'>
      <fieldset>
        <div class="col-md-12">
         <label for="category" class="form-label">Category Name</label>
         <input type="text" class="form-control" id="category" name="category" >
         
      </div>
    
     <br>
        <input type="submit" class="btn btn-primary" name="create" value="Create">
    
   </fieldset>
</form>
    </div>
  </div>
</div>



<?php
require_once("footer.php"); 
?>
