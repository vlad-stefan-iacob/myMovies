<?php

@include 'config.php'; //conectarea la baza de date

session_start();

if(!isset($_SESSION['home_page_name'])){ //nu se poate accesa pagina de home daca nu ai trecut de cea de login cu succes
   header('location:login_form.php');
}

$query_int= mysqli_query($conn,"SELECT f.title, 
                                        (SELECT ROUND(AVG (r.grade),2) FROM review r WHERE
                                        r.film_ID = f.film_ID) AS average_grade
                                        FROM film f
                                        ORDER BY average_grade DESC
                                        LIMIT 3");

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include "./menu.php"?>

<div class="container">

   <div class="content">
      <h3>Welcome <span><?php echo $_SESSION['home_page_name'] ?></span></h3>
      <br><hr size="4" width="100%" color="white"><br>

   <form action="" method="post" enctype="multipart/form-data">
   <p style = "color: white"><b>Top 3 movies</b></p>
    <table class = "int-list">
        <tr>
            <th>Film title</th>
            <th>Average score</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($query_int) > 0){
            while ($row_int = mysqli_fetch_assoc($query_int))
            {   
            echo "
            <tr>
                <td>".$row_int['title']."</td>
                <td>".$row_int['average_grade']."</td>
            </tr>
            ";
            }
        } 
        ?>   
   </table>
   </form>
   </div>
</div>
</body>
</html>