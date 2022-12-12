	
<?php

require('connection.php');

deb($_POST);
deb($_SESSION,1);

if ($_POST["captcha"] != $_SESSION["captcha"])  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
	else{
		echo "<script>alert('Verification code match !');</script>" ;
	}

 $captcha = trim(filter_input(INPUT_POST,'captcha',FILTER_SANITIZE_EMAIL));

    if($captcha == $_SESSION['captcha'])
    {
        echo "aksjkhjnlbvldgkj dfpbvljdpoer;jvpodfljkbvoflrgvkjmrdlvjdsp";
    }








if((isset($_POST['post'])  && !empty($_POST['comment']) )) 
{
	 // Sanitize user input to escape HTML entities and filter out dangerous characters.

 $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 if(isset($_SESSION['user_id']))
 {
 $user = $_SESSION['email'];
}
else 
{
	$user = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}




    $query = "INSERT INTO comments(comment,submitted_by) values(:comment,:user)";
    $statement = $db->prepare($query);
    $statement->bindValue(':comment',$comment);
    $statement->bindValue(':user',$user);

    $statement->execute();
   
     



}


else
{
    echo '<script>alert("Please enetr a comment")';
    exit(0);
}

?>

<style type="text/css">
	#message
	{
		background-color: #A9C9FF;
background-image: linear-gradient(180deg, #A9C9FF 0%, #FFBBEC 100%);
width: 50%;
margin: auto;

	}

	#message p 
	{
		font-size: 30px;
		padding: 30px;
	}
</style>



<div id="message">
	<p> Thank you for yor feedback!! We love to hear from you!</p>

</div>

<div class="row row-cols-1 row-cols-md-3 g-4">


