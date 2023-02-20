<?php
    @include 'config.php'; //conectarea la baza de date
   
    session_start();
    //interogare pentru obtinerea ID-ului filmului selectat
    $query = "SELECT * FROM film";
    $result = mysqli_query($conn,$query);

    //dupa ce se selecteaza din lista filmul dorit si se apasa YES acesta va urma sa fie sters
    if(isset($_POST['delete_film'])){
        
        $film_ID = mysqli_real_escape_string($conn, $_POST['formDeleteFilm']); //selectia filmului
        mysqli_query($conn, "DELETE from film WHERE film_ID = '$film_ID'"); //stergerea din baza de date
        header('location: movies.php?');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Delete film</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="delete-review">
    <form action="" method="post" enctype="multipart/form-data">
        <p style="color:white">What FILM do you want to delete?</p><br>
        <!-- in acest <select> apar toate filmele din baza de date, lista din care se alege o optiune pt a fi stearsa -->
        <select name="formDeleteFilm"> 
            <?php
                while ($row = mysqli_fetch_assoc($result)){  
            ?>
            <option value="<?php echo $row['film_ID'];?>">
                <?php echo $row['title'];?> 
            </option>
            <?php
                }
            ?>
        </select>
        <br><br>
        <p style="color:white">Are you sure you want to delete this FILM?</p>
        
        <input type="submit" value="Yes" name="delete_film" class="btn">
        <?php echo"<a href='movies.php' class='back-btn'>No</a>"?>   
    </form>
    </div>



</body>
</html>