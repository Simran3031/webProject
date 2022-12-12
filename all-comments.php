 <?php 
require_once("connection.php");
require_once("header.php");

$query= "SELECT * FROM comments ORDER BY comment_id DESC ";
$statement = $db->prepare($query);
$statement->execute();


?>


<style type="text/css">
    h1
    {
        width: 20%;
        margin: auto;
    }
    .card
    {
        height: 200px;
    }
    .row
    {
        width: 80%;
        margin-bottom: 30px;
    }
</style>

<h1>All Comments</h1>
<div class="row row-cols-3 row-cols-md-3 g-3">


<?php while ($comment= $statement->fetch()): ?>


 <div class="col">
    <div class="card border-danger">
      <div class="card-body">
        <h5 class="card-title"><?= $comment['comment'] ?></h5>

        <p class="card-text">by <?= $comment['submitted_by'] ?> on <?= $comment['date_created'] ?></p>
      </div>
    </div>
  </div>



        <?php endwhile; ?> 

            </div>
