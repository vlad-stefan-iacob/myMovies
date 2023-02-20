<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    $cast_id=$_GET['filmid']; //obtinerea ID-ului filmului ales din tabel pentru care se introduce un actor
    
    if(isset($_POST['submit'])){

      //obtinerea datelor din formularul de inserare
        $insert_firstname = mysqli_real_escape_string($conn, $_POST['insert_firstname']);
        $insert_lastname = mysqli_real_escape_string($conn, $_POST['insert_lastname']);
        $insert_role = mysqli_real_escape_string($conn, $_POST['insert_role']);

      //inserarea in baza de date in tabela ACTOR
        $insert_actor = "INSERT INTO actor(actorfirstname, actorlastname, role) VALUES('$insert_firstname','$insert_lastname', '$insert_role')";
        mysqli_query($conn, $insert_actor);
        header('location:insert_cast.php?castid='.$cast_id.'');
   };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add actors</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<div class="insert-movie">
   <form action="" method="post" enctype="multipart/form-data">
   <h3>ADD ACTORS</h3>
   <!-- formularul de inserare al actorilor -->
   <div class="flex">
         <div class="inputBox">
            <span>First name : </span>
            <input type="text" name="insert_firstname" class="box">
            <span>Last name : </span>
            <input type="text" name="insert_lastname" class="box">
            <span>Role : </span>
            <input type="text" name="insert_role" class="box">
        </div>
   </div>
      <input type="submit" name="submit" value="Insert actor"  class="btn">
      <?php echo"<a href='cast.php?castid=".$cast_id."' class='back-btn'><i class='fa fa-undo' aria-hidden='true'></i> Back</a>"?>   </form>
</div>


</body>
</html>