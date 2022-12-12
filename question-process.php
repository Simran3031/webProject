<?php
 require('connection.php');


if((isset($_POST['submitQuestion']) || isset($_POST['submitQuestionAdmin']) ) && !empty($_POST['questionInput']) )
{
	 // Sanitize user input to escape HTML entities and filter out dangerous characters.

   $question = filter_input(INPUT_POST, 'questionInput', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = $_SESSION['email'];
   echo $email;

    // $query = "SELECT user_id FROM users WHERE email = :email"; # user_id
    // $statement = $db->prepare($query);
    // $statement->bindValue(':email', $email);
    // $statement->execute();
    // $user= $statement->fetch();

    // $user_id = $user['user_id'];

    $user_id = $_SESSION['user_id'];

    $queryQuestion = "INSERT INTO questions(question,user_id) values(:question,:user_id)";
  	$statementQuestion = $db->prepare($queryQuestion);
  	$statementQuestion->bindValue(':question',$question);
    $statementQuestion->bindValue(':user_id',$user_id);

  	$statementQuestion->execute();
     
     if(isset($_POST['submitQuestion']) )
     {
         header("Location: questions.php");
        exit();
     }
     elseif(isset($_POST['submitQuestionAdmin']) )
     {
            echo '<script>alert("Question Saved");
          window.location.href="view-questions.php";</script>';
     }
  	
}

elseif(isset($_POST['submitQuestion']) || isset($_POST['submitQuestionAdmin']) ) 
{
    if(!isset($_POST['questionInput']) || empty($_POST['questionInput']))
    {
        echo '<script>alert("Please enter a quesyion");
        window.location.href="questions.php";</script>';
        exit(0);
    }  
}
   
?>