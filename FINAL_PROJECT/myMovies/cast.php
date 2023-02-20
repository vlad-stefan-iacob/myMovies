<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    $cast_id = $_GET['castid'];
    
    //interogare pentru obtinerea regizorului si scenaristului filmului curent
    $query = "SELECT * FROM castandcrew, film WHERE $cast_id = castandcrew.film_ID AND castandcrew.film_ID = film.film_ID";
    $result = mysqli_query($conn,$query);

    //interogare pentru obtinerea titlului filmului
    $query_title = "SELECT * FROM film WHERE $cast_id = film_ID";
    $result_title = mysqli_query($conn,$query_title);
    $row_title = mysqli_fetch_assoc($result_title);

    //interogare pentru obtinerea actorilor care joaca in filmul respectiv
    $query_actors = "SELECT * FROM actor,castandcrew WHERE $cast_id = castandcrew.film_ID AND actor.actor_ID = castandcrew.actor_ID";
    $result_actors = mysqli_query($conn,$query_actors);

    //interogare pentru obtinerea ID-ului filmului
    $query_filmID = "SELECT * FROM film WHERE $cast_id = film_ID";
    $result_filmID = mysqli_query($conn,$query_filmID);
    $row_filmID = mysqli_fetch_assoc($result_filmID);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cast and crew</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<?php include "./menu.php"?>

<div class = "cast-container">
        <ul>
            <li><a href="movies.php"><b><p style="border: 1px solid white;border-radius: 20px;"><i class="fa fa-undo" aria-hidden="true"></i> Back</p></b></a></li>
        </ul>
        <?php 
            if ($_SESSION['user_id'] == 9){ //posibilitatea de adaugare de distributie doar de catre administrator
        ?>
            <ul>
                <li><?php echo"<a href=insert_actor.php?filmid=".$row_filmID['film_ID']."><b><p style='border: 1px solid white;border-radius: 20px;'><i class='fa fa-plus'></i> Add Cast</p></b></a>"?></li>
            </ul>
           
        <?php
            }
        ?>
       <p>Cast and crew for "<?php echo $row_title['title']?>"</p>
    <table class = "cast-list">
        <tr>
            <th><p>&nbsp;&nbsp;&nbsp;&nbsp;Director&nbsp;&nbsp;&nbsp;&nbsp;</p></th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Writer&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        <tr>
            <?php
                if ($row = mysqli_fetch_assoc($result)) //afisarea regizorului si scenaristului sub forma de tabel
                {
            ?> 
                <td>&nbsp;&nbsp;<?php echo $row['director']; ?>&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;<?php echo $row['writer']; ?>&nbsp;&nbsp;</td>           
                </tr>
            <?php
                } 
            ?>   
    </table>
    <table class = "actor-list">
        <tr>
            <th colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;Actors&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;First name&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Last name&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;Role&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
        <tr>
            <?php
                while ($row = mysqli_fetch_assoc($result_actors)) //afisarea actorilor sub forma de tabel
                {
            ?> 
                <td>&nbsp;&nbsp;<?php echo $row['actorfirstname']; ?>&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;<?php echo $row['actorlastname']; ?>&nbsp;&nbsp;</td>  
                <td>&nbsp;&nbsp;<?php echo $row['role']; ?>&nbsp;&nbsp;</td>    
        </tr>
            <?php
                } 
            ?>   
    </table>
</div>

</body>
</html>