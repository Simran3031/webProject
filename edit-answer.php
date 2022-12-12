 <?php 
require_once("connection.php");
require('authenticate.php');
require_once("header.php");
    


    $answer_id = filter_input(INPUT_GET, 'answer_id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM answer WHERE answer_id = :answer_id "; 
    $statement = $db->prepare($query);
    $statement->bindValue(':answer_id', $answer_id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch();


?>


<style type="text/css">
    #answerForm
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
    
        </div>
    </nav>
<form action="edit-answer-process.php" id="answerForm" method="post" >
        <h1>Update Answer</h1>
      <fieldset class="row g-3">
             
            <input type="hidden" class="form-control" id="answer_id" name="answer_id" value="<?= $answer_id ?>"> 

            <div id="questionPart">
             <div class="col-md-8">
            <label for="question" class="form-label">Answer</label>
            <textarea class="form-control" id="answer" name="answer"><?= $row["answer"] ?></textarea> 
             </div>
             

        <div class="buttons">
        <input type="submit" class="btn btn-primary col-md-2" name="update" value="Update Answer">
        <input type="submit" class="btn btn-primary col-md-2" name="delete" value="Delete Answer" onclick="return confirm('Are you sure you wish to delete this question?')" id="delete">
    </div>
</div>

           

   </fieldset>
</form>



<?php
require_once("footer.php"); 
?>