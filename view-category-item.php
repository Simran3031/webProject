<?php 
require_once("connection.php");
require_once("header.php");


$category_id = filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_NUMBER_INT);


$query= "SELECT * FROM questions WHERE category_id = :category_id";
$Statement = $db->prepare($query);
$Statement->bindValue(':category_id',$category_id);
$Statement->execute();


$queryCategory= "SELECT * FROM categories WHERE category_id = :category_id";
$StatementCategory = $db->prepare($queryCategory);
$StatementCategory->bindValue(':category_id',$category_id);
$StatementCategory->execute();
$category_fetch = $StatementCategory->fetch()

?>

	<style type="text/css">
		.dashboard-nav
		{
			margin: auto;
		}

		.cardDiv
		{
			
			width: 98%;
			margin: 0 auto;
			margin-top: 2rem;
		}

		.card
		{
			margin: 10px;
			border-radius: 10px;
			display: inline-flex; 
			height: 450px;
			max-height: 450px;
			overflow-y: scroll;
		}

		.textareaAnswer
		{
			width: 90%;
			margin: auto;
		}

		#questionBtnSection
		{
			margin:0 auto;
			width: 90%;
		}

		#heading
		{
			width: 100%;
		}

		#heading h1
		{
			font-size: 50px;
			width: 10%;
			margin: auto;
		}

	</style>
<nav class="navbar navbar-expand-lg dashboard-nav col-md-11">
		<div class="container-fluid d-flex">

			<p>Welcome <?php echo $_SESSION["email"];   ?></p>
	
			
		</div>
	</nav>




<div id="heading">
	<h1><?= $category_fetch['category']  ?></h1>
</div>

	<div class="cardDiv">

		<?php while ($question = $Statement->fetch()): ?>
			
			<div class="card text-bg-secondary mb-3" style="width: 43rem;">
				<?php $ques = $question['question_id'] ?>
				<?php $user_id = $question['user_id'] ?>
				<?php $queryUser= "SELECT * from users where user_id = :user_id";?>
							<?php $fetchUserStatement = $db->prepare($queryUser); ?>
							<?php $fetchUserStatement->bindValue(':user_id', $user_id); ?>	
							<?php $fetchUserStatement->execute(); ?>
							<?php $user_fetch = $fetchUserStatement->fetch() ?>
				<div class="card-header"><?= $ques ?>. asked by <b><?= $user_fetch['email'] ?> </b>
					<p class="date"><small><?= $question['date_created'] ?></small></p></div>
					<div class="card-body">
						<h5 class="card-title"><?= $question['question'] ?></h5>
						
						<div class="card-body">
							<form method="post" action="answer-add.php?question_id=<?=$question['question_id']?>">
						<div class="mb-3 textareaAnswer">
						<label for="postAnswer" class="form-label">Post an Answer:</label>
						<textarea class="form-control" name="postAnswer" rows="3"></textarea>
						<button type="submit" class="btn mt-2 btn-danger"  id="answer" name="answer">
						Add
					</button>

					</div>
					</form>
							<?php $answer= "SELECT * from answer where question_id = :ques ORDER BY answer_id DESC";?>
							<?php $answerStatement = $db->prepare($answer); ?>
							<?php $answerStatement->bindValue(':ques', $ques); ?>	
							<?php $answerStatement->execute(); ?>
							<?php if($answerStatement->rowCount()  > 0): ?>
								<h6>Answers</h6>
								<?php while ($answers = $answerStatement->fetch()): ?>

                            <?php $user_id = $answers['user_id']; ?>
							<?php $user= "SELECT * from users where user_id = :user_id";?>
							<?php $userStatement = $db->prepare($user); ?>
							<?php $userStatement->bindValue(':user_id', $user_id); ?>	
							<?php $userStatement->execute(); ?>
							<?php $user = $userStatement->fetch() ?>

									<p><?= $answers['answer']; ?> <small><i>-answered on <?= $answers['date_answered'] ?> by <?= $user['firstname']." ".$user['lastname']; ?></i></small></p>

								<?php endwhile; ?>
							<?php endif; ?>	
						</div>
					</div>
					
				</div>
				
			<?php endwhile ?>
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

while ($category = $Statement->fetch()): ?>

  
      <option value="<?= $category['category_id'] ?>" ><?= $category['category'] ?></option> 
  <?php endwhile; ?>
    </select>
  </div>
		</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submitQuestion">Submit</button>
      </div>
	</form>
      
    </div>
  </div>
</div>



<?php
require_once("footer.php"); 
?>
