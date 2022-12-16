<?php
require('connection.php');

   $answer = filter_input(INPUT_POST, 'postAnswer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $question_id = filter_input(INPUT_GET, 'question_id', FILTER_VALIDATE_INT);
   $user_id = $_SESSION['user_id'];

if((isset($_POST['answer']) || isset($_POST['submitAnswerAdmin'])) && !empty($_POST['postAnswer']))
{

    $query = "INSERT INTO answer(answer,question_id,user_id) values(:answer,:question_id,:user_id)";
    $statement = $db->prepare($query);
    $statement->bindValue(':answer',$answer);
    $statement->bindValue(':question_id',$question_id);
    $statement->bindValue(':user_id',$user_id); 
    $statement->execute();

   //If answer exsists
    if(isset($_POST['answer']))
    {
           header("Location: questions.php");
     exit();
    }

    elseif(isset($_POST['submitAnswerAdmin']))
    {
        echo '<script>alert("Answer saved");
          window.location.href="view-questions.php";</script>';
    }
  
}

elseif(isset($_POST['answer']) || isset($_POST['submitAnswerAdmin']) ) 
{
    if(!isset($_POST['postAnswer']) || empty($_POST['postAnswer']))
    {
        if(isset($_POST['answer']))
        {
        echo '<script>alert("Please enter an answer.");
        window.location.href="questions.php";</script>';
        exit(0);
        }
        elseif(isset($_POST['submitAnswerAdmin']))
    {
        echo '<script>alert("Please enter an answer");
          window.location.href="view-questions.php";</script>';
    }
    }  
}

?>
