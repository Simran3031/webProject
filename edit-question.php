 <?php 
require_once("connection.php");
require('authenticate.php');
require_once("header.php");
	


	$question_id = filter_input(INPUT_GET, 'question_id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM questions WHERE question_id = :question_id "; 
    $statement = $db->prepare($query);
    $statement->bindValue(':question_id', $question_id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch();


    $queryAnswer = "SELECT * FROM answer WHERE question_id = :question_id "; 
    $statementAnswer = $db->prepare($queryAnswer);
    $statementAnswer->bindValue(':question_id', $question_id, PDO::PARAM_INT);
    $statementAnswer->execute();
    
?>


<style type="text/css">
    #questionForm
    {
        width: 90%;
        margin: auto;
    }


#delete
{
    margin-left: 20px;
}

.table
{
    margin: auto;
    margin-top: 3rem;
}

#questionPart
{
    margin: auto;
    width: 80%;
}

.buttons
{
    margin-top: 1rem;
}



</style>

<nav class="navbar navbar-expand-lg dashboard-nav col-md-11">
        <div class="container-fluid d-flex">

            <p>Welcome <?php echo $_SESSION["email"]; ?></p>

            <button type="button" class="btn btn-success" id="questionBtn" data-bs-toggle="modal" data-bs-target="#answerModal">
            Create an answer
    
        </div>
    </nav>
<form action="edit-question-process.php" id="questionForm" method="post" >
        <h1>Update Question</h1>
      <fieldset class="row g-3">
             
            <input type="hidden" class="form-control" id="question_id" name="question_id" value="<?= $question_id ?>"> 

            <div id="questionPart">
             <div class="col-md-8">
            <label for="question" class="form-label">Question</label>
            <textarea class="form-control" id="question" name="question"><?= $row["question"] ?></textarea> 
             </div>
             

        <div class="buttons">
        <input type="submit" class="btn btn-primary col-md-2" name="update" value="Update Question">
        <input type="submit" class="btn btn-primary col-md-2" name="delete" value="Delete Question" onclick="return confirm('Are you sure you wish to delete this question?')" id="delete">
    </div>
</div>

            <div class="col-md-12">

             <table class="table table-primary table-striped table-responsive table-bordered">
              <thead>
                <tr>
                  <th scope="col">Answre ID</th>
                  <th scope="col">Answer</th>
                  <th scope="col">Date</th>
                  <th colspan="2">Answered by</th>
                </tr>
              </thead>
              <tbody>
                   <?php while($answer = $statementAnswer->fetch()): ?>
                        <tr>
                  <th scope="row"><?= $answer["answer_id"] ?></th>
                  <td><?= $answer["answer"] ?></td>
                  <td><?= $answer["date_answered"] ?></td>

                  <?php 
                    $id = $answer['user_id'];
                    $queryUser = "SELECT email FROM users WHERE user_id = $id ";
                    $statementUser = $db->prepare($queryUser);
                    $statementUser->execute();
                    $userId = $statementUser->fetch();
                  ?>
                  <td><?= $userId["email"] ?></td>
                  <td><a href="edit-answer.php?answer_id=<?= $answer['answer_id'] ?>" >-edit</a></td>
                </tr>
                 

                    <?php endwhile; ?> 
                        
                    </tbody>
                </table>
                        
                </div>    
        

   </fieldset>
</form>


<!-- Modal -->
<div class="modal fade" id="answerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Put your Answer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="questionForm" action="answer-add.php" method="post">
        
        <div class="mb-3">
            <label for="postAnswer" class="form-label">Your answer</label>
            <textarea class="form-control" class="postAnswer" name="postAnswer" rows="3"></textarea>
        </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submitAnswerAdmin">Submit</button>
      </div>
    </form>
      
    </div>
  </div>
</div>



<?php
require_once("footer.php"); 
?>