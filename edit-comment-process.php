<?php

require('connection.php');

if(isset($_POST['update']) && !empty($_POST['comment'])) 
{
     // Sanitize user input to escape HTML entities and filter out dangerous characters.
 $comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);





    $query = "UPDATE comments SET comment = :comment WHERE comment_id = :comment_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':comment',$comment);
    $statement->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);

    $statement->execute();



    echo '<script>alert("Comment updated");
          window.location.href="view-comments.php";</script>';
//exit();
}


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

elseif(isset($_POST["delete"])) 
{
   
   $comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = "DELETE FROM comments WHERE comment_id = :comment_id ";
    $statement = $db->prepare($query);

    $statement->bindValue(':comment_id', $comment_id);

    $statement->execute();

    echo '<script>alert("Comment Deleted");
                    window.location.href="view-comments.php";</script>';
        exit;
}
?>