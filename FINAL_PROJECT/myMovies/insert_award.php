<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    $award_id=$_GET['filmid']; //obtinerea ID-ului filmului ales din tabel pentru care se introduce un premiu
    
    if(isset($_POST['submit'])){
      
      //obtinerea datelor din formularul de inserare
        $insert_type = mysqli_real_escape_string($conn, $_POST['insert_type']);
      
        //inserarea in baza de date in tabela AWARD
        $insert_award = "INSERT INTO award(type) VALUES('$insert_type')";
        mysqli_query($conn, $insert_award);
        header('location:insert_awarddate.php?awardid='.$award_id.'');
   };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add award</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<div class="insert-movie">
   <form action="" method="post" enctype="multipart/form-data">
   <h3>ADD AWARD</h3>
    <!-- formularul de inserare al actorilor -->
   <div class="flex">
         <div class="inputBox">
            <span>Award type : </span>
            <input type="text" name="insert_type" class="box">
        </div>
   </div>
      <input type="submit" name="submit" value="Next " class="btn" >
      <?php echo"<a href='award.php?awardid=".$award_id."' class='back-btn'><i class='fa fa-undo' aria-hidden='true'></i> Back</a>"?>   </form>
</div>


</body>
</html>