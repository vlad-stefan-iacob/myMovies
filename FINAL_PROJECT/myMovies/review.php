<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    $user_id = $_SESSION['user_id']; //obtinerea ID-ului userului conectat
    
    $id=$_GET['reviewid']; //obtinerea ID-ului filmului ales din tabel pentru care se doreste vizualizarea review-urilor
    //afisarea datelor din tabela REVIEW si username-ul din tabela USER
    $query = "SELECT * FROM review,user WHERE $id = review.film_ID AND user.user_ID = review.user_ID";
    $result = mysqli_query($conn,$query);

    //obtinerea ID-ului filmului selectat
    $query_filmID = "SELECT * FROM film WHERE $id = film_ID";
    $result_filmID = mysqli_query($conn,$query_filmID);
    $row_filmID = mysqli_fetch_assoc($result_filmID);

    //obtinerea titlului filmului selectat
    $query_title = "SELECT * FROM film WHERE $id = film_ID";
    $result_title = mysqli_query($conn,$query_title);
    $row_title = mysqli_fetch_assoc($result_title);

    //aflarea mediei notelor filmului selectat
    $query_avg = "SELECT ROUND(AVG(grade),1) AS `avg` FROM review WHERE $id = film_ID";
    $result_avg = mysqli_query($conn,$query_avg);
    $row_avg = mysqli_fetch_array($result_avg);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reviews</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<?php include "./menu.php"?>

<div class = "review-container">
        <ul>
            <!-- buton de adaugare a unui nou review -->
            <li><?php echo"<a href=insert_review.php?filmid=".$row_filmID['film_ID']."><b><p style='border: 1px solid white;border-radius: 20px;'><i class='fa fa-plus'></i> New review</p></b></a>"?></li>
            <li><a href="movies.php"><b><p style="border: 1px solid white;border-radius: 20px;"><i class="fa fa-undo" aria-hidden="true"></i> Back</p></b></a></li>
       </ul>
    <p>Reviews for "<?php echo $row_title['title']?>"</p>
    <p>Average score: <?php echo $row_avg['avg']?></p>

    <table class = "review-list">
        <!-- afisarea informatiilor din tabela REVIEW sub forma de tabel -->
        <tr>
            <th><p>&nbsp;&nbsp;&nbsp;&nbsp;Added by&nbsp;&nbsp;&nbsp;&nbsp;</p></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Review date&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Grade&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Comment&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Edit review&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Delete review&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        <tr>
            <?php
                while ($row = mysqli_fetch_assoc($result))
                {
            ?> 
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['watcheddate']; ?></td>
                <td><?php echo $row['grade']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                <td><?php 
                // vizibilitatea butoanelor de Edit si Delete doar pentru userul care a oferit respectivul review
                    if ($_SESSION['user_id']== $row['user_ID']){ echo"
                        <a href='update_review.php?updateid=".$row_title['film_ID']."'>
                        <p style='color:black;
                        background-color: white;
                        width: 100%;
                        border: 1px solid white;
                        margin: 10px 0 10px;
                        font-size: 18px;
                        border-radius: 20px;
                        box-sizing: border-box;
                        cursor: pointer;
                        font-weight: bold;
                        text-align: center' >Edit</p>
                        </a>"?>
                    <?php } else{ ?>
                        <p style="color: white; font-size: 18px; text-align: center;"> <i class="fa fa-times" aria-hidden="true"></i></p>
                  <?php } ?>
                </td>
                <td><?php 
                    if ($_SESSION['user_id']== $row['user_ID']){ echo"
                        <a href='delete_review.php?deleteid=".$row_title['film_ID']."'>
                        <p style='color:black;
                        background-color: white;
                        width: 100%;
                        border: 1px solid white;
                        margin: 10px 0 10px;
                        font-size: 18px;
                        border-radius: 20px;
                        box-sizing: border-box;
                        cursor: pointer;
                        font-weight: bold;
                        text-align: center' >Delete</p>
                        </a>"?>
                    <?php } else{ ?>
                        <p style="color: white; font-size: 18px; text-align: center;"> <i class="fa fa-times" aria-hidden="true"></i></p>
                  <?php } ?>
                </td>
        </tr>
            <?php
                } 
            ?>   
    </table>
</div>
</body>
</html>