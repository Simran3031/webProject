<?php 
require_once("connection.php");
require_once("header.php");

/*
$email = filter_input(INPUT_GET,'email',FILTER_SANITIZE_EMAIL);


$query= "SELECT * from users where email = :email";
$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->execute();

$user = $statement->fetch();
$firstname = $user['firstname'];
$_SESSION['name'] = $firstname;
*/

$questions= "SELECT * FROM questions";




$query= "SELECT * FROM categories ";
$Statement = $db->prepare($query);
$Statement->execute();

if(isset($_GET['sortBtn']))
{
    $questions = "SELECT * FROM questions ORDER BY date_created DESC";
}
$questionStatement = $db->prepare($questions);
$questionStatement->execute();



?>

	<style type="text/css">
		.dashboard-nav
		{
			margin: auto;
		}

		.cardDiv
		{
			
			width: 98%;
			margin: 0 auto;
			margin-top: 2rem;
		}

		.card
		{
			margin: 10px;
			border-radius: 10px;
			display: inline-flex; 
			height: 450px;
			max-height: 450px;
			overflow-y: scroll;
		}

		.textareaAnswer
		{
			width: 90%;
			margin: auto;
		}

		#questionBtnSection
		{
			margin:0 auto;
			width: 90%;
		}

	</style>


<nav class="navbar navbar-expand-lg dashboard-nav col-md-11">
		<div class="container-fluid d-flex">

			<p>Welcome <?php echo $_SESSION["email"];   ?></p>
				
		<form class="d-flex justify-content-end" role="search" id="search_form" onsubmit="myFunction()">
        <input class="form-control me-2"  type="text" id ="input_category" name="input_category" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" id="search" value="search" onclick ="validate(event); ">Search</button>
      </form>
			
		</div>
	</nav>

	

	<section id="questionBtnSection">
		<button type="button" class="btn btn-success" id="questionBtn" data-bs-toggle="modal" data-bs-target="#questionModal">
			Ask a question
		</button>
		
	<!-- 	<button type="button" class="btn btn-success" id="sortBtn" name="sortBtn">
			Show latest questions
		</button> -->
	</section>


<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid d-flex">
   
    <div class="collapse navbar-collapse" id="categoriesNav">
      <ul class="navbar-nav  justify-content-end">
      	<?php while ($categoryFetch = $Statement->fetch()): ?>

  
        <li class="nav-item">
          <a class="nav-link" href="view-category-item.php?category_id=<?= $categoryFetch['category_id'] ?>"><?= $categoryFetch['category'] ?></a>
        </li>
  <?php endwhile; ?>


       
      </ul>
    </div>
  </div>
</nav>


	<div class="cardDiv" id="cardContainer">
		<?php while ($question = $questionStatement->fetch()): ?>
			
			<div class="card text-bg-secondary mb-3" style="width: 43rem;">
				<?php $ques = $question['question_id'] ?>
				<?php $user_id = $question['user_id'] ?>
				<?php $queryUser= "SELECT * from users where user_id = :user_id";?>
							<?php $fetchUserStatement = $db->prepare($queryUser); ?>
							<?php $fetchUserStatement->bindValue(':user_id', $user_id); ?>	
							<?php $fetchUserStatement->execute(); ?>
							<?php $user_fetch = $fetchUserStatement->fetch() ?>
				<div class="card-header"><?= $ques ?>. asked by <b><?= $user_fetch['email'] ?> </b>
					<p class="date"><small><?= $question['date_created'] ?></small></p></div>
					<div class="card-body">
						<h5 class="card-title"><?= $question['question'] ?></h5>
						
						<div class="card-body">
							<form method="post" action="answer-add.php?question_id=<?=$question['question_id']?>">
						<div class="mb-3 textareaAnswer">
						<label for="postAnswer" class="form-label">Post an Answer:</label>
						<textarea class="form-control" name="postAnswer" rows="3"></textarea>
						<button type="submit" class="btn mt-2 btn-danger"  id="answer" name="answer">
						Add
					</button>

					</div>
					</form>
							<?php $answer= "SELECT * from answer where question_id = :ques ORDER BY answer_id DESC";?>
							<?php $answerStatement = $db->prepare($answer); ?>
							<?php $answerStatement->bindValue(':ques', $ques); ?>	
							<?php $answerStatement->execute(); ?>
							<?php if($answerStatement->rowCount()  > 0): ?>
								<h6>Answers</h6>
								<?php while ($answers = $answerStatement->fetch()): ?>

                            <?php $user_id = $answers['user_id']; ?>
							<?php $user= "SELECT * from users where user_id = :user_id";?>
							<?php $userStatement = $db->prepare($user); ?>
							<?php $userStatement->bindValue(':user_id', $user_id); ?>	
							<?php $userStatement->execute(); ?>
							<?php $user = $userStatement->fetch() ?>

									<p><?= $answers['answer']; ?> <small><i>-answered on <?= $answers['date_answered'] ?> by <?= $user['firstname']." ".$user['lastname']; ?></i></small></p>

								<?php endwhile; ?>
							<?php endif; ?>	
						</div>
					</div>
					
				</div>
				
			<?php endwhile ?>
		</div>





<!-- Modal -->
<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ask a question</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="questionForm" action="question-process.php" method="post">
		
		<div class="mb-3">
			<label for="questionInput" class="form-label">Your question</label>
			<textarea class="form-control" class="questionInput" name="questionInput" rows="3"></textarea>
		</div>
		 <div class="mb-3">
    <label for="inputState" class="form-label">Category</label>
<select id="inputState" class="form-select" name= "category">
   <?php 

$query= "SELECT * FROM categories ";
$Statement = $db->prepare($query);
$Statement->execute();
while ($category = $Statement->fetch()): ?>

  
      <option value="<?= $category['category_id'] ?>" ><?= $category['category'] ?></option> 
  <?php endwhile; ?>
    </select>
  </div>
		</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submitQuestion">Submit</button>
      </div>
	</form>
      
    </div>
  </div>
</div>


<script type="text/javascript">
		function sort() {

			document.getElementById("cardContainer").innerHTML = "";
			 <?php
			 $questions= "SELECT * FROM questions ORDER BY date_created DESC";
$questionStatement = $db->prepare($questions);
$questionStatement->execute();

			  ?>

			
		}
		

		function validate(event)
		{
			
			event.preventDefault();
			const inputCategory = document.getElementById("input_category");
			const searchTerm = inputCategory.value.trim();
			if(searchTerm !== "")
			{
				fetchData(searchTerm);
			}
		}

		function fetchData(searchTerm)
		{
			const apiUrl = 'https://data.winnipeg.ca/resource/4her-3th5.json?' +
			`$where=service_area LIKE '%${searchTerm}%'` +
			'&$order=service_area DESC' +
			'&$limit=100';

			fetch(encodeURI(apiUrl))
			.then(function (result) {
    			return result.json(); // Promise for parsed JSON.
    		})
			.then(function (data) {
    			// Executed when promised JSON is ready.
    			processSearchResults(data, searchTerm)
    		});

			function processSearchResults(data, searchTerm)
			{

				displayInformation(data, searchTerm);
				displayMessage(data, searchTerm);
			}

		}

		function displayMessage(data, searchTerm)
		{
			const notFoundMessage = document.getElementById("notFound");
			const foundMessage = document.getElementById("found");

			notFoundMessage.innerHTML = `There is no service named ${searchTerm}.`;
			foundMessage.innerHTML = `Here are the services having ${searchTerm} in their name`;

			if(data.length > 0)
			{
				notFoundMessage.style.display = "none";
				foundMessage.style.display = "block";
			}
			else
			{
				notFoundMessage.style.display = "block";
				foundMessage.style.display = "none";
			}
		}


		function displayInformation(data,searchTerm)
		{ 
			
           document.getElementById("serviceData").innerHTML = "";

			const body = document.getElementsByTagName("body")[0];
			const area = document.getElementById("serviceData");

			for(let i = 0; i < data.length; i++)
			{
				
				let section = document.createElement("section");
				section.setAttribute('class', 'card');
				let h2 = document.createElement("h2");
				let ul = document.createElement("ul");
				let keys = ["Service area", "Date", "Request", "Ward","Neighbourhood"];
				let values = [];
				values.push(data[i].service_area);
				values.push(data[i].sr_date);
				values.push(data[i].service_request);
				values.push(data[i].ward);
				values.push(data[i].neighbourhood);

				area.appendChild(section);
				section.appendChild(ul);

				for (let j = 0; j < keys.length; j++)
				{
					let li = document.createElement("li");
					let label = document.createElement("label");
					let span = document.createElement("span");
					label.innerHTML = `${keys[j]}:   `;
					span.innerHTML = `${values[j]}`;

					li.appendChild(label);
					li.appendChild(span);
					ul.appendChild(li);
				}
			}
		}

	</script>




<?php
require_once("footer.php"); 
?>
