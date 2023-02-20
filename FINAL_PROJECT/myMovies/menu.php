<?php

@include 'config.php'; //conectarea la baza de date

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>
<header class = "header">
    <section class = "flex">
      <!-- logo-ul aplicatiei -->
       <a href="home_page.php" class="logo"><i class="fa fa-film"></i><i><b> myMovies</b></i></a> 
       <!-- informatie cu privire la userul care este conectat -->
       <p style="color: white">You are logged in as <b><?php echo $_SESSION['home_page_name'] ?>&nbsp;</span></b></p>
       <ul>
       <?php 
        if ($_SESSION['user_id'] == 9){ //butonul de Statistic vizibil doar administratorului
      ?>
         <li><a href="statistic.php"><b><p style='border: 1px solid white;border-radius: 20px;'> Statistic</p></b></a></li>
      <?php
        }
      ?>
      <!-- butoanele din meniul de navigare -->
         <li><a href="home_page.php"><b><p style="border: 1px solid white;border-radius: 20px;">Home</p></b></a></li>
          <li><a href="movies.php"><b><p style="border: 1px solid white;border-radius: 20px;">Movies</p></b></a></li>
          <li><a href=""><b><p style="border: 1px solid white;border-radius: 20px;">Profile</p></b></a>
             <ul>
                <li><a href="update_profile.php"><i class="fa fa-pencil"></i><b>Edit</b></a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i><b> Logout</b></a></li>
             </ul>
          </li>
       </ul>
    </section>
 </header> 
</body>
</html>