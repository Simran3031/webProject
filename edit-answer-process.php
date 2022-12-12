<?php

require('connection.php');

if(isset($_POST['update']) && !empty($_POST['answer'])) 
{
     // Sanitize user input to escape HTML entities and filter out dangerous characters.
 $answer_id = filter_input(INPUT_POST, 'answer_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $answer = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);





    $query = "UPDATE answer SET answer = :answer WHERE answer_id = :answer_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':answer',$answer);
    $statement->bindValue(':answer_id', $answer_id, PDO::PARAM_INT);

    $statement->execute();



    echo '<script>alert("Answer updated");
          window.location.href="view-questions.php";</script>';
//exit();
}
elseif(empty($_POST['answer']))
{
    echo '<script>alert("Please enter the value for answer.");
          window.location.href="view-questions.php";</script>';
}


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

elseif(isset($_POST["delete"])) 
{
   
   $answer_id = filter_input(INPUT_POST, 'answer_id', FILTER_SANITIZE_NUMBER_INT);

    $query = "DELETE FROM answer WHERE answer_id = :answer_id ";
    $statement = $db->prepare($query);

    $statement->bindValue(':answer_id', $answer_id);

    $statement->execute();

     echo '<script>alert("Answer Deleted");
          window.location.href="view-questions.php";</script>';
        exit;
}
?>