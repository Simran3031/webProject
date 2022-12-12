<?php

 require('connection.php');



if(isset($_POST['signup']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user']))
{
	 // Sanitize user input to escape HTML entities and filter out dangerous characters.

   $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $user_role = $_POST['user'];

  	$query = "INSERT INTO users(firstname,lastname,email,password,user_role) values(:firstname,:lastname,:email,:password,:user_role)";
  	$statement = $db->prepare($query);
  	$statement->bindValue(':firstname',$firstname);
    $statement->bindValue(':lastname',$lastname);
    $statement->bindValue(':email',$email);
    $statement->bindValue(':password',$password);
    $statement->bindValue(':user_role',$user_role);

  	$statement->execute();

  	 header("Location: login.php");
  	 exit();



   
}
   
?>