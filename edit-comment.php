<?php

require_once("connection.php");
require('authenticate.php');
require_once("header.php");
   


   $comment_id = filter_input(INPUT_GET, 'comment_id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM comments WHERE comment_id = :comment_id "; 
    $statement = $db->prepare($query);
    $statement->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch();
?>

<style type="text/css">
       #commentForm
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

#commentPart
{
    margin: auto;
    width: 90%;
}

.buttons
{
    margin-top: 1rem;
}Comment
</style>

<nav class="navbar navbar-expand-lg dashboard-nav col-md-11">
        <div class="container-fluid d-flex">

            <p>Welcome <?php echo $_SESSION["email"]; ?></p>

         
    </nav>


    <form action="edit-comment-process.php" id="commentForm" method="post" >
        <h1>Update Comment</h1>
      <fieldset >
             
            <input type="hidden" class="form-control" id="comment_id" name="comment_id" value="<?= $comment_id ?>"> 

            <div id="commentPart">
             <div class="col-md-8">
            <label for="question" class="form-label">Comment</label>
            <textarea class="form-control" id="comment" name="comment"><?= $row["comment"] ?></textarea> 
             </div>
             

        <div class="buttons">
        <input type="submit" class="btn btn-primary col-md-2" name="update" value="Update Comment">
        <input type="submit" class="btn btn-primary col-md-2" name="delete" value="Delete Comment" onclick="return confirm('Are you sure you wish to delete this comment?')" id="delete">
    </div>
</div>

            

   </fieldset>
</form>
