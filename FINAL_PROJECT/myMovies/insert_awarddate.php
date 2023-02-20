<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    $award_id=$_GET['awardid']; //obtinerea ID-ului filmului ales din tabel pentru care se introduce data in care s-a obtinut un premiu

    //obtinerea ID-ului premiului introdus pentru care se va introduce si data premierei
    $query_award = "SELECT * FROM award ORDER BY award_ID DESC LIMIT 1";
    $result_award = mysqli_query($conn, $query_award);
    $row_award = mysqli_fetch_assoc($result_award);
    $awardid = $row_award['award_ID'];

    if(isset($_POST['submit'])){

      //obtinerea datelor din formularul de inserare
        $insert_awarddate = mysqli_real_escape_string($conn, $_POST['insert_awarddate']);

        //inserarea in baza de date in tabela AWARDEDFILM
        $insert_awardedfilm = "INSERT INTO awardedfilm(film_ID, award_ID, awardeddate) VALUES('$award_id', '$awardid','$insert_awarddate')";
        mysqli_query($conn, $insert_awardedfilm);
        header('location:award.php?awardid='.$award_id.'');
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
      $select = mysqli_query($conn, "SELECT * FROM awardedfilm WHERE film_ID = $award_id");
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }

   ?>

   <form action="" method="post" enctype="multipart/form-data">
   <h3>ADD THE AWARDED DATE</h3>
    <!-- formularul de inserare al datei in care s-a premiat un film -->
   <div class="flex">
         <div class="inputBox">
            <span>Date : </span>
            <input type="date" name="insert_awarddate" class="box">
        </div>
   </div>
      <input type="submit" name="submit" value="Insert award"  class="btn">
   </form>
</div>


</body>
</html>