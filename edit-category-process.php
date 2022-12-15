<?php 
require('connection.php');

if( isset($_POST['create'])  && !empty($_POST['category']) ) 
{
	 // Sanitize user input to escape HTML entities and filter out dangerous characters.

 $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);



    $query = "INSERT INTO categories(category) values(:category)";
    $statement = $db->prepare($query);
    $statement->bindValue(':category',$category);
    $statement->execute();

    echo '<script>alert("Category Created");
    window.location.href="view-categories.php";</script>';
    exit(0);
}

elseif(empty($_POST['category']))
{
     echo '<script>alert("Please enter a category");
    window.location.href="view-categories.php";</script>';
    exit(0);



}
elseif(isset($_POST['update']) && !empty($_POST['category'])) 
{
     // Sanitize user input to escape HTML entities and filter out dangerous characters.
 $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);





    $query = "UPDATE categories SET category = :category WHERE category_id = :category_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':category',$category);
    $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);

    $statement->execute();



    echo '<script>alert("Category updated");
          window.location.href="view-categories.php";</script>';
//exit();
}


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

elseif(isset($_POST["delete"])) 
{
   
   $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = "DELETE FROM categories WHERE category_id = :category_id ";
    $statement = $db->prepare($query);

    $statement->bindValue(':category_id', $category_id);

    $statement->execute();

   echo '<script>alert("Category Deleted");
          window.location.href="view-categories.php";</script>';

        exit;
}



?>