<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    $award_id = $_GET['awardid'];
    
    //interogare pentru obtinerea datei cand a fost premiat un film
    $query = "SELECT * FROM awardedfilm, film WHERE $award_id = awardedfilm.film_ID AND awardedfilm.film_ID = film.film_ID";
    $result = mysqli_query($conn,$query);

    //interogarea pentru obtinerea titlului filmului curent
    $query_title = "SELECT * FROM film WHERE $award_id = film_ID";
    $result_title = mysqli_query($conn,$query_title);
    $row_title = mysqli_fetch_assoc($result_title);

    //interogare pentru obtinerea premiului care va fi afisat
    $query_awards = "SELECT * FROM award, awardedfilm WHERE $award_id = awardedfilm.film_ID AND award.award_ID = awardedfilm.award_ID";
    $result_awards = mysqli_query($conn,$query_awards);

    //interogarea pentru obtinerea ID-ului filmului curent
    $query_filmID = "SELECT * FROM film WHERE $award_id = film_ID";
    $result_filmID = mysqli_query($conn,$query_filmID);
    $row_filmID = mysqli_fetch_assoc($result_filmID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Awards</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<?php include "./menu.php"?>

<div class = "award-container">
        <ul>
            <li><a href="movies.php"><b><p style="border: 1px solid white;border-radius: 20px;"><i class="fa fa-undo" aria-hidden="true"></i> Back</p></b></a></li>
       </ul>
       <?php 
            if ($_SESSION['user_id'] == 9){ //posibilitatea de adaugare de premii doar de catre administrator
        ?>
            <ul>
                <li><?php echo"<a href=insert_award.php?filmid=".$row_filmID['film_ID']."><b><p style='border: 1px solid white;border-radius: 20px;'><i class='fa fa-plus'></i> Add Award</p></b></a>"?></li>
            </ul>
           
        <?php
            }
        ?>
       <p>Awards for "<?php echo $row_title['title']?>"</p>
    <table class = "award-list">
        <tr>
            <th><p>&nbsp;&nbsp;&nbsp;&nbsp;Awarded date&nbsp;&nbsp;&nbsp;&nbsp;</p></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Award&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        <tr>
            <?php
                //afisarea premiilor si a datelor cand au fost premiate filmele sub forma de tabel
                while ($row = mysqli_fetch_assoc($result) and $row_awards = mysqli_fetch_assoc($result_awards))
                {
            ?> 
                <td>&nbsp;&nbsp;<?php echo $row['awardeddate']; ?>&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;<?php echo $row_awards['type']; ?>&nbsp;&nbsp;</td>
        </tr>
            <?php
                } 
            ?>   
    </table>
</div>

</body>
</html>