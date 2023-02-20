<?php
   @include 'config.php'; //conectarea la baza de date
   
   session_start();
   $user_id = $_SESSION['user_id']; //obtinerea ID-ului userului conectat
   $film_id=$_GET['filmid']; //obtinerea ID-ului filmului pentru care se introduce un review

   if(isset($_POST['submit'])){

      //obtinerea datelor din formularul de inserare al campurilor pentru un review
      $insert_date = date('Y-m-d');
      $insert_grade = mysqli_real_escape_string($conn, $_POST['insert_grade']);
      $insert_comment = mysqli_real_escape_string($conn, $_POST['insert_comment']);
      
      //inserarea in baza de date in tabela REVIEW
      $insert = "INSERT INTO review(user_ID, film_ID, watcheddate, grade, comment) VALUES('$user_id','$film_id','$insert_date','$insert_grade','$insert_comment')";
      mysqli_query($conn, $insert);
      header('location:review.php?reviewid='.$film_id.'');
   };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add review</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<div class="insert-review">
   <form action="" method="post" enctype="multipart/form-data">
   <h3>ADD NEW REVIEW</h3>
   <!-- formularul de inserare al datelor pentru un review -->
   <div class="flex">
         <div class="inputBox">
            <span>Date : <?php echo date('Y-m-d');?></span>
            <span>Grade :</span>
            <input type="number" name="insert_grade" min="1" max="10" class="box-grade">
            <span>Comment :</span>
            <textarea name="insert_comment" class="box-comment"></textarea>
         </div>
   </div>
      <input type="submit" name="submit" value="Insert review"  class="btn">
      <?php echo"<a href='review.php?reviewid=".$film_id."' class='back-btn'><i class='fa fa-undo' aria-hidden='true'></i> Back</a>"?>
   </form>
</div>


</body>
</html>