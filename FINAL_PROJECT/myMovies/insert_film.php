<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    
    if(isset($_POST['submit'])){

      //obtinerea datelor din formularul de inserare al informatiilor despre un film
        $insert_title = mysqli_real_escape_string($conn, $_POST['insert_title']);
        $insert_date = mysqli_real_escape_string($conn, $_POST['insert_date']);
        $insert_origin = mysqli_real_escape_string($conn, $_POST['insert_origin']);
        $insert_language = mysqli_real_escape_string($conn, $_POST['insert_language']);
        $insert_genre = mysqli_real_escape_string($conn, $_POST['insert_genre']);
      
        //inserarea in baza de date in tabela FILM
        $insert = "INSERT INTO film(title, releasedate, origin, language, genre) VALUES('$insert_title','$insert_date','$insert_origin','$insert_language','$insert_genre')";
        mysqli_query($conn, $insert);
        header("location:movies.php");
   };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add film</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<div class="insert-movie">
   <form action="" method="post" enctype="multipart/form-data">
   <h3>ADD NEW MOVIE</h3>
    <!-- formularul de inserare al informatiilor de baza ale unui film -->
   <div class="flex">
         <div class="inputBox">
            <span>Title : </span>
            <input type="text" name="insert_title" class="box">
            <span>Release date : </span>
            <input type="date" name="insert_date" class="box">
            <span>Origin : </span>
            <input type="text" name="insert_origin" class="box">
        </div>
        <div class="inputBox">
            <span>Language : </span>
            <input type="text" name="insert_language" class="box">
            <span>Genre : </span>
            <input type="text" name="insert_genre" class="box">
        </div>
   </div>
      <input type="submit" name="submit" value="Insert movie"  class="btn">
      <a href="movies.php" class='back-btn'><i class='fa fa-undo' aria-hidden='true'></i> Back</a>
   </form>
</div>


</body>
</html>