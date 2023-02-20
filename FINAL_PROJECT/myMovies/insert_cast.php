<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    $cast_id=$_GET['castid']; //obtinerea ID-ului filmului ales din tabel pentru care se introduce o distributie
   
    //interogare pentru obtinerea ultimului actor introdus caruia urmeaza sa i se asocieze un regizor si un scenarist
    $query_actor = "SELECT * FROM actor ORDER BY actor_ID DESC LIMIT 1";
    $result_actor = mysqli_query($conn, $query_actor);
    $row_actor = mysqli_fetch_assoc($result_actor);
    $actorid = $row_actor['actor_ID'];

   //obtinerea datelor din formularul de inserare al regizorului si scenaristului
    if(isset($_POST['submit'])){

        $insert_director = mysqli_real_escape_string($conn, $_POST['insert_director']);
        $insert_writer = mysqli_real_escape_string($conn, $_POST['insert_writer']);

        //inserarea in baza de date in tabela CASTANDCREW
        $insert_cast = "INSERT INTO castandcrew(actor_ID, film_ID, director, writer) VALUES('$actorid','$cast_id','$insert_director','$insert_writer')";
        mysqli_query($conn, $insert_cast);
        header('location:cast.php?castid='.$cast_id.'');
   };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add cast</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<div class="insert-movie">
   <?php
      $select = mysqli_query($conn, "SELECT * FROM castandcrew WHERE film_ID = $cast_id");
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }

   ?>

   <form action="" method="post" enctype="multipart/form-data">
   <h3>ADD DIRECTOR & WRITER</h3>
    <!-- formularul de inserare al regizorului si scenaristului unui film -->
   <div class="flex">
         <div class="inputBox">
            <span>Director : </span>
            <?php
               if(mysqli_num_rows($select) > 0){
            ?>
            <input type="text" name="insert_director" value="<?php echo $fetch['director']; ?>" class="box">
            <?php
               }
            ?>
            <?php
               if(mysqli_num_rows($select) == 0){
            ?>
            <input type="text" name="insert_director" class="box">
            <?php
               }
            ?>
            
            <span>Writer : </span>
            <?php
               if(mysqli_num_rows($select) > 0){
            ?>
            <input type="text" name="insert_writer" value="<?php echo $fetch['writer']; ?>" class="box">
            <?php
               }
            ?>
            <?php
               if(mysqli_num_rows($select) == 0){
            ?>
            <input type="text" name="insert_writer" class="box">
            <?php
               }
            ?>
        </div>
   </div>
      <input type="submit" name="submit" value="Insert cast"  class="btn">
   </form>
</div>


</body>
</html>