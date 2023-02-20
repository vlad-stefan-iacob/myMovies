<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();
    //interogare pentru obtinerea datelor din tabela FILM
    $query = "SELECT * FROM film";
    $result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Movies</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<?php include "./menu.php"?>

<div class = "movie-container">
    <?php 
        if ($_SESSION['user_id'] == 9){ //butoanele de inserare si stergere de film vizibile doar administratorului
    ?>
    <ul>
        <li><a href="insert_film.php"><b><p style='border: 1px solid white;border-radius: 20px;'><i class='fa fa-plus'></i> New movie</p></b></a></li>
        <li><a href="delete_film.php"><b><p style='border: 1px solid white;border-radius: 20px;'><i class='fa fa-trash'></i> Delete movie</p></b></a></li>
    </ul>
    <?php
        }
    ?>
    
    <h3> List of all movies </h3>
    <!-- afisarea datelor din tabela FILM sub forma de tabel -->
    <table class = "movie-list">
        <tr>
            <th>Title</th>
            <th>Release date</th>
            <th>Origin</th>
            <th>Language</th>
            <th>Genre</th>
            <th>Review</th>
            <th>Cast</th>
            <th>Awards</th>
        </tr>
        
        <?php
            while ($row = mysqli_fetch_assoc($result))
            {   
            echo "
            <tr>
                <td>".$row['title']."</td>
                <td>".$row['releasedate']."</td>
                <td>".$row['origin']."</td>
                <td>".$row['language']."</td>
                <td>".$row['genre']."</td>
                <td><a href='review.php?reviewid=".$row['film_ID']."'> 
                        <p style='color:black;
                        background-color: white;
                        width: 100%;
                        border: 1px solid white;
                        margin: 10px 0 10px;
                        font-size: 18px;
                        border-radius: 20px;
                        box-sizing: border-box;
                        cursor: pointer;
                        font-weight: bold;' ><i class='fa fa-eye' aria-hidden='true'></i> Reviews</p>
                    </a>
                </td>
                <td><a href='cast.php?castid=".$row['film_ID']."'> 
                        <p style='color:black;
                        background-color: white;
                        width: 100%;
                        border: 1px solid white;
                        margin: 10px 0 10px;
                        font-size: 18px;
                        border-radius: 20px;
                        box-sizing: border-box;
                        cursor: pointer;
                        font-weight: bold;'><i class='fa fa-eye' aria-hidden='true'></i> Cast</p>
                    </a>
                </td>
                <td><a href='award.php?awardid=".$row['film_ID']."'>
                        <p style='color:black;
                        background-color: white;
                        width: 100%;
                        border: 1px solid white;
                        margin: 10px 0 10px;
                        font-size: 18px;
                        border-radius: 20px;
                        box-sizing: border-box;
                        cursor: pointer;
                        font-weight: bold;'> <i class='fa fa-eye' aria-hidden='true'></i> Awards</p>
                    </a>
                </td>
            </tr>
            ";
            } 
            ?>   
    </table>
</div>

</body>
</html>