 <?php 
require_once("connection.php");
require_once("header.php");

$query= "SELECT * FROM users ORDER BY user_id DESC";
$statement = $db->prepare($query);
$statement->execute();
$user = $statement->fetch();

$questions= "SELECT * FROM questions ORDER BY question_id DESC";
$questionStatement = $db->prepare($questions);
$questionStatement->execute();



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
	
		<button type="button" class="btn btn-success" id="questionBtn" data-bs-toggle="modal" data-bs-target="#questionModal">
			Create a question
		</button>
		</div>
	</nav>

	<div class="tableDiv">
		<table class="table table-success table-striped table-responsive table-bordered">
  <thead>
    <tr>
      <th scope="col">Question ID</th>
      <th scope="col">Question</th>
      <th scope="col">Date</th>
      <th scope="col">Category</th>
      <th colspan="2">Asked by</th>
    </tr>
  </thead>
  <tbody>

<?php while ($question = $questionStatement->fetch()):  ?>
<tr>
      <th scope="row"><?= $question["question_id"] ?></th>
      <td><?= $question["question"] ?></td>
      <td><?= $question["date_created"] ?></td>

      <?php 
      $id = $question['user_id'];
      $queryUser = "SELECT email FROM users WHERE user_id = $id ";
			$statementUser = $db->prepare($queryUser);
			$statementUser->execute();
			$userId = $statementUser->fetch();
      ?>

    
  <?php 
      $cid = $question['category_id'];
      $queryCategory = "SELECT category FROM categories WHERE category_id = $cid ";
      $statementCategory = $db->prepare($queryCategory);
      $statementCategory->execute();
      $category = $statementCategory->fetch();
      ?>

       <td><?= $category["category"] ?></td>

      <td><?= $userId["email"] ?></td>
      <td><a href="edit-question.php?question_id=<?= $question["question_id"]  ?>" >-edit</a></td>
    </tr>
<?php endwhile; ?>


		</tbody>
	</table>
		</div>


<!-- Modal -->
<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ask a question</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="questionForm" action="question-process.php" method="post">
		
		<div class="mb-3">
			<label for="questionInput" class="form-label">Your question</label>
			<textarea class="form-control" class="questionInput" name="questionInput" rows="3"></textarea>
		</div>
     <div class="mb-3">
    <label for="inputState" class="form-label">Category</label>
<select id="inputState" class="form-select" name= "category">
    <?php 

$query= "SELECT * FROM categories ";
$Statement = $db->prepare($query);
$Statement->execute();
while ($category = $Statement->fetch()): ?>

  
      <option value="<?= $category['category_id'] ?>" ><?= $category['category'] ?></option> 
  <?php endwhile; ?>
    </select>
  </div>

		</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submitQuestionAdmin">Submit</button>
      </div>
	</form>
      
    </div>
  </div>
</div>

<?php
require_once("footer.php"); 
?>
