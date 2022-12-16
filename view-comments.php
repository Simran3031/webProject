 <?php 
require_once("connection.php");
require_once("header.php");

//Latest first
$query= "SELECT * FROM comments ORDER BY comment_id DESC";
$Statement = $db->prepare($query);
$Statement->execute();



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
	
		
		</div>
	</nav>
	<div class="tableDiv">
		<table class="table table-success table-striped table-responsive table-bordered">
  <thead>
    <tr>
      <th scope="col">Comment ID</th>
      <th scope="col">Comment</th>
      <th scope="col">Date</th>
      <th colspan="2">Submitted by</th>
    </tr>
  </thead>
  <tbody>

<?php while ($comment = $Statement->fetch()):  ?>
<tr>
      <th scope="row"><?= $comment["comment_id"] ?></th>
      <td><?= $comment["comment"] ?></td>
      <td><?= $comment["date_created"] ?></td>

     

      <td><?= $comment["submitted_by"] ?></td>
      <input type="hidden" name="comment_id" value="<?= $comment["comment_id"]  ?>">
      <td><a href="edit-comment.php?comment_id=<?= $comment["comment_id"]  ?>" >-edit</a></td>
    </tr>
<?php endwhile; ?>


		</tbody>
	</table>
		</div>




<?php
require_once("footer.php"); 
?>
