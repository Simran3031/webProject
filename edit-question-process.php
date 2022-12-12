<?php

require('connection.php');

if(isset($_POST['update']) && !empty($_POST['question'])) 
{
     // Sanitize user input to escape HTML entities and filter out dangerous characters.
 $question_id = filter_input(INPUT_POST, 'question_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $question = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_FULL_SPECIAL_CHARS);





    $query = "UPDATE questions SET question = :question WHERE question_id = :question_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':question',$question);
    $statement->bindValue(':question_id', $question_id, PDO::PARAM_INT);

    $statement->execute();



    echo '<script>alert("Question updated");
          window.location.href="view-questions.php";</script>';
//exit();
}


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

elseif(isset($_POST["delete"])) 
{
   
   $question_id = filter_input(INPUT_POST, 'question_id', FILTER_SANITIZE_NUMBER_INT);

    $query = "DELETE FROM questions WHERE question_id = :question_id ";
    $statement = $db->prepare($query);

    $statement->bindValue(':question_id', $question_id);

    $statement->execute();

    echo '<script>alert("Question Deleted");
                    window.location.href="view-questions.php";</script>';
        exit;
}
?>