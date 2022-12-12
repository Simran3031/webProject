 <?php 
require_once("connection.php");

$query= "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5";
$statement = $db->prepare($query);
$statement->execute();


?>



	<style type="text/css">
		/* Footer */
#footer {
    padding: 30px 0;
    max-height: 30px;
    width: 100%;
}

.row
{
	width: 100%;
}


@media (max-width:767px){
	#footer h5 {
    padding-left: 0;
    border-left: transparent;
    padding-bottom: 0px;
    margin-bottom: 10px;
}
}

.commentForm
{
	width: 30%;
	margin: auto;
	border: 1px solid grey;
	padding: 20px;
	margin-top: 30px;
}

.card-group
{
	margin: 10px;
}

.card
{
	margin: 20px;
}

h1
{
	font-size: 20px;
	margin-top: 30px;
	padding-top: 30px;
	margin-left: 30px;
}

#all_comments
{
	width: 10%;
	margin: auto;
}

	</style>

	<section id="footer " class="bg-light">
		<h1>Comments by users</h1>
		<div class="card-group">


<?php while ($comment= $statement->fetch()): ?>


 
    <div class="card ">
      <div class="card-body">
        <h5 class="card-title"><?= $comment['comment'] ?></h5>

        <p class="card-text">by <?= $comment['submitted_by'] ?> on <?= $comment['date_created'] ?></p>
      </div>
    </div>
  



		<?php endwhile; ?> 

			</div>
			<div id="all_comments">
				<a href="all-comments.php" >View all comments...</a>
			</div>


<div id="formDiv">
<form class="row g-3 commentForm" method="post" action="post-comment.php">
	 <?php if(isset($_SESSION['user_id'])): ?>
        
       <div class="col-md-12">
    <label for="userEmail" class="form-label">Email</label>
    <input type="email" class="form-control" id="userEmail" value="<?= $_SESSION['email'] ?>" name="email" disabled>
  </div>
        <?php else: ?>
         <div class="col-md-12">
    <label for="userName" class="form-label">Name</label>
    <input type="text" class="form-control" id="userName" name="name">
  </div>
      <?php endif; ?>
  
  <div class="col-md-12">
    <label for="comment" class="form-label">Comment</label>
    <textarea class="form-control"  id="comment" name="comment"></textarea>
  </div>

  <div class="col-12">
<label for="captcha"><?=  $_SESSION['captcha'] ?></label>


<label for="captcha">Please Enter the Captcha Text</label>
    <img src="captcha.php" alt="CAPTCHA" class="captcha-image "><p><a href='javascript: refreshCaptcha();'>click here</a>
to refresh</p>
    <br>
    <input class="form-control"  type="text" id="captcha" name="captcha" >

</div>
   
  <div class="col-12">
    <button type="submit" class="btn btn-danger" name="post">Post</button>
  </div>
</form>

</div>
		<div class="container">
			
			
			<div class="row">
				<div class=" text-center ">
					<p class="h6">© All rights Reversed.<u>Simran Kaur</u></p>
				</div>
				<hr>
			</div>	
		</div>
	</section>
	<!-- ./Footer -->


	
	

	<!-- bootstrap js file -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

	<!-- custom javascript file -->
	<script type="text/javascript" src="js/script.js"></script>

</body>
</html>