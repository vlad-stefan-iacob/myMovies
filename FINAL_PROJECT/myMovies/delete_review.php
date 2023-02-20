<?php
    @include 'config.php'; //conectarea la baza de date
   
    session_start();
    $user_id = $_SESSION['user_id']; //obtinerea ID-ului userului conectat
    $film_id=$_GET['deleteid']; //obtinerea ID-ului filmului selectat

    if(isset($_POST['delete_review'])){
    
        mysqli_query($conn, "DELETE from `review` WHERE user_ID = '$user_id' AND film_ID = '$film_id'"); //stergerea review-ului ales
        header('location: review.php?reviewid='.$film_id.'');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Delete review</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="delete-review">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Are you sure you want to delete this REVIEW?</h3>
        
        <input type="submit" value="Yes" name="delete_review" class="btn">
        <?php echo"<a href='review.php?reviewid=".$film_id."' class='back-btn'>No</a>"?>   
    </form>
    </div>



</body>
</html>