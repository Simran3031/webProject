<?php

require_once("connection.php");
require('authenticate.php');
require_once("header.php");
   


   $category_id = filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE category_id = :category_id "; 
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
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

#categoryPart
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


    <form action="edit-category-process.php" id="commentForm" method="post" >
        <h1>Update category</h1>
      <fieldset >
             
            <input type="hidden" class="form-control" id="category_id" name="category_id" value="<?= $category_id ?>"> 

            <div id="categoryPart">
             <div class="col-md-8">
            <label for="category" class="form-label">Category</label>
            <textarea class="form-control" id="category" name="category"><?= $row["category"] ?></textarea> 
             </div>
             

        <div class="buttons">
        <input type="submit" class="btn btn-primary col-md-2" name="update" value="Update Category">
        <input type="submit" class="btn btn-primary col-md-2" name="delete" value="Delete Category" onclick="return confirm('Are you sure you wish to delete this category?')" id="delete">
    </div>
</div>

            

   </fieldset>
</form>

<?php
require_once('footer.php');
?>
