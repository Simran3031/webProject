<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Portal for International Students</title>

	<!-- font awesome link -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

	<!-- bootstrap link -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css">

	<!-- custom css file -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
<style>
  #logoutLink
{
   border-radius: 10px;
   color: white;
}
</style>

</head>
<body>

<header class="header">
	<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid d-flex">
    <a class="navbar-brand" href="#">Portal for International Students</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About the Portal</a>
        </li>
        <?php if(isset($_SESSION['user_id'])): ?>
        
        <li class="nav-item">
          <a class="nav-link bg-dark" href="logout.php" id="logoutLink">Logout</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      <?php endif; ?>

      
       <?php if(isset($_SESSION['user_id'])): ?>
        <?php if($_SESSION['user_role'] == "0"): ?>

           <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 10px;">
              Explore Around
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="admin-dashboard.php">Dashboard</a></li>
              <li><a class="dropdown-item" href="users.php">View Users</a></li>
              <li><a class="dropdown-item" href="view-questions.php">Go to Questions</a></li>
               <li><a class="dropdown-item" href="view-comments.php">View Comments</a></li>
              <li><a class="dropdown-item" href="update-profile.php">Update you profile</a></li>
            </ul>
          </div>
        <?php elseif($_SESSION['user_role'] == "1"): ?> 
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 10px;">
              Explore Around
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="visitor-dashboard.php">Dashboard</a></li>
              <li><a class="dropdown-item" href="questions.php">Ask Questions</a></li>
              <li><a class="dropdown-item" href="update-profile.php">Update you profile</a></li>
            </ul>
          </div>
          <?php endif; ?>
          
      <?php endif; ?>



      </ul>
    </div>
  </div>
</nav>
</header>
