<?php 
require_once("connection.php");
require_once("header.php");
?>

<style type="text/css">
   #home
{
   background-color: aqua;
   height: 40rem;
   background-image: url('images/home-picture.jpg');
   background-repeat: no-repeat;
   background-size: cover;
   
}

 .content{
   width: 50rem;
   padding:2rem;
   color:#ffffff;
   background-color: #000000;
   opacity: 75%;
   
}

#home .content h1{
   font-size: 6rem;
}

#home .content p{
   line-height: 2;
   font-size: 1.5rem;
   padding:0.5rem 0;
}

</style>
<section id="home">

   <div id="containerIndex">

      <div id="rowIndex">
         <div class="content">
            <h1>YOU BELONG HERE</h1>
            <p>We are here to help. Join us today to get your questions answered</p>
         </div>
      </div>
   </div>
</section>
	

<?php
require_once("footer.php"); 
?>