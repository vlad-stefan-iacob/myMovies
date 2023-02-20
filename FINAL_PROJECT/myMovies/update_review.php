<?php

@include 'config.php'; //conectarea la baza de daate
   
session_start();
$user_id = $_SESSION['user_id']; //obtinerea ID-ului utilizatorului conectat
$film_id=$_GET['updateid']; //obtinerea ID-ului filmului pentru care se doreste actualizarea review-ului

if(isset($_POST['update_review'])){
   //obtinerea datelor din formularul de actualizare a review-ului
    $update_date = date('Y-m-d');
    $update_grade = mysqli_real_escape_string($conn, $_POST['update_grade']);
    $update_comment = mysqli_real_escape_string($conn, $_POST['update_comment']);

    //actualizarea datelor din baza de date din tabela REVIEW
    mysqli_query($conn, "UPDATE `review` SET watcheddate = '$update_date', grade = '$update_grade', 
    comment = '$update_comment' WHERE user_ID = '$user_id' AND film_ID = '$film_id'");

    $message_ok[] = 'Review updated successfully!';   
}
    
?>

<?php include "./menu.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit review</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="update-review">
    <?php
      //obtinerea datelor din tabela REVIEW pentru precompletarea campurilor din formular
      $select = mysqli_query($conn, "SELECT * FROM `review` WHERE user_ID = '$user_id' AND film_ID = '$film_id'");
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

    <form action="" method="post" enctype="multipart/form-data">
      <h3>EDIT REVIEW</h3>
      <?php
         if(isset($message_ok)){
            foreach($message_ok as $message_ok){
               echo '<div class="message_ok">'.$message_ok.'</div>';
            }
            
         }
      ?>
      <!-- formularul de actualizare al informatiilor din review -->
      <div class="flex">
         <div class="inputBox">
            <span>Date : <?php echo date('Y-m-d');?></span>
            <span>Your grade :</span>
            <input type="number" name="update_grade" min="1" max="10" value="<?php echo $fetch['grade']; ?>" class="box-grade">
            <span>Your comment :</span>
            <textarea class="box-comment" name="update_comment"><?php echo $fetch['comment']; ?></textarea>
         </div>
      </div>
      <input type="submit" value="Update review" name="update_review" class="btn">
      <?php echo"<a href='review.php?reviewid=".$film_id."' class='back-btn'><i class='fa fa-undo' aria-hidden='true'></i> Back</a>"?>   </form>

</div>
</body>
</html>