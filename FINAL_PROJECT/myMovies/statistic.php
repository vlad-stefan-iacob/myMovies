<?php
    @include 'config.php'; //conectarea la baza de date
    session_start();

//===========interogare 1=========================================

    $query_user = "SELECT * FROM user";
    $result_user = mysqli_query($conn,$query_user);
    $row_int1 = 0;
    $username = '';
    if(isset($_POST['show_int1'])){
        
        $username = mysqli_real_escape_string($conn, $_POST['form_users']);
        $query_int1= mysqli_query($conn,   "SELECT COUNT(r.grade) AS Nr
                                            FROM review r RIGHT JOIN user u
                                            ON r.user_ID = u.user_ID
                                            WHERE u.username = '$username'");
         $row_int1 = mysqli_fetch_array($query_int1);
    }

//===========interogare 2=========================================

    $query_film = "SELECT * FROM film";
    $result_film = mysqli_query($conn,$query_film);
    $row_int2 = 0;
    $title = '';
    if(isset($_POST['show_int2'])){
        
        $title = mysqli_real_escape_string($conn, $_POST['form_film']);
        $query_int2= mysqli_query($conn,    "SELECT COUNT(r.grade) AS Nr
                                            FROM review r LEFT JOIN film f
                                            ON r.film_ID = f.film_ID
                                            WHERE f.title = '$title'");
         $row_int2 = mysqli_fetch_array($query_int2);
    }
    
//===========interogare 3=========================================

    $row_int3 = 0;
    $grade1 = 0;
    $grade2 = 0;
    if(isset($_POST['show_int3'])){
        
        $grade1 = mysqli_real_escape_string($conn, $_POST['form_grade1']);
        $grade2 = mysqli_real_escape_string($conn, $_POST['form_grade2']);
        $query_int3= mysqli_query($conn,    "SELECT COUNT(DISTINCT f.title) AS Nr
                                            FROM film f INNER JOIN review r
                                            ON f.film_ID = r.film_ID
                                            WHERE (r.grade > $grade1 && r.grade < $grade2)");
        $row_int3 = mysqli_fetch_array($query_int3);
    }

//===========interogare 4=========================================

    $query_award = "SELECT * FROM award";
    $result_award = mysqli_query($conn,$query_award);
    $type = ' ';
    $query_int4= mysqli_query($conn,    "SELECT f.title, a.type, af.awardeddate FROM film f 
                                            LEFT JOIN awardedfilm af ON f.film_ID = af.film_ID
                                            LEFT JOIN award a ON a.award_ID = af.award_ID
                                            WHERE a.type = '$type'");
    if(isset($_POST['show_int4'])){
        
        $type = mysqli_real_escape_string($conn, $_POST['form_award']);
        $query_int4= mysqli_query($conn,    "SELECT f.title, a.type, af.awardeddate FROM film f 
                                            LEFT JOIN awardedfilm af ON f.film_ID = af.film_ID
                                            LEFT JOIN award a ON a.award_ID = af.award_ID
                                            WHERE a.type = '$type'");
    }

//===========interogare 5=========================================

    $date = 0;
    $query_int5= mysqli_query($conn,"SELECT f.title, af.awardeddate 
                                    FROM film f LEFT JOIN awardedfilm af
                                    ON f.film_ID = af.film_ID
                                    WHERE year(awardeddate) < $date
                                    ORDER BY awardeddate");
    if(isset($_POST['show_int5'])){
        
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $query_int5= mysqli_query($conn,"SELECT f.title, af.awardeddate 
                                        FROM film f LEFT JOIN awardedfilm af
                                        ON f.film_ID = af.film_ID
                                        WHERE year(awardeddate) < $date
                                        ORDER BY awardeddate");
    }

//===========interogare 6=========================================

    $query_role = "SELECT * FROM actor";
    $result_role = mysqli_query($conn,$query_role);
    $role = '';
    $query_int6= mysqli_query($conn,"SELECT f.title, a.actorfirstname, a.actorlastname, a.role, c.director 
                                    FROM film f 
                                    LEFT JOIN castandcrew c ON f.film_ID = c.film_ID
                                    LEFT JOIN actor a ON a.actor_ID = c.actor_ID
                                    WHERE a.role = '$role'");
    if(isset($_POST['show_int6'])){
        
        $role = mysqli_real_escape_string($conn, $_POST['form_role']);
        $query_int6= mysqli_query($conn,"SELECT f.title, a.actorfirstname, a.actorlastname, a.role, c.director FROM film f 
                                        LEFT JOIN castandcrew c ON f.film_ID = c.film_ID
                                        LEFT JOIN actor a ON a.actor_ID = c.actor_ID
                                        WHERE a.role = '$role'");
    }

//===========interogare 7=========================================

    $query_int7= mysqli_query($conn,"SELECT u.firstname, u.lastname, u.username FROM user u
                                    WHERE u.user_ID NOT IN
                                    (
                                        SELECT r.user_ID FROM review r
                                        JOIN user u1 ON r.user_ID = u1.user_ID
                                    )
                                    ORDER BY u.username");
    if(isset($_POST['show_int7'])){
        
        $query_int7= mysqli_query($conn,"SELECT u.firstname, u.lastname, u.username FROM user u
                                        WHERE u.user_ID NOT IN
                                        (
                                            SELECT r.user_ID FROM review r
                                            JOIN user u1 ON r.user_ID = u1.user_ID
                                        )
                                        ORDER BY u.username");
    }

//===========interogare 8=========================================

    $query_int8= mysqli_query($conn,"SELECT u.firstname, u.lastname, u.username, COUNT(r.grade) AS NrReview 
                                    FROM review r JOIN user u ON r.user_ID = u.user_ID
                                    WHERE EXISTS
                                    (
                                        SELECT r1.user_ID FROM review r1
                                        WHERE r.user_ID = r1.user_ID
                                    )
                                    GROUP BY r.user_ID
                                    ORDER BY NrReview DESC");
    if(isset($_POST['show_int8'])){
        
        $query_int7= mysqli_query($conn,"SELECT u.firstname, u.lastname, u.username, COUNT(r.grade) AS NrReview 
                                        FROM review r JOIN user u ON r.user_ID = u.user_ID
                                        WHERE EXISTS
                                        (
                                            SELECT r1.user_ID FROM review r1
                                            WHERE r.user_ID = r1.user_ID
                                        )
                                        GROUP BY r.user_ID
                                        ORDER BY NrReview DESC");
    }

//===========interogare 9=========================================

    $query_actor1 = "SELECT * FROM actor";
    $result_actor1 = mysqli_query($conn,$query_actor1);
    $query_actor2 = "SELECT * FROM actor";
    $result_actor2 = mysqli_query($conn,$query_actor2);
    $actor_firstname = '';
    $actor_lastname = '';
    $query_int9= mysqli_query($conn,"SELECT f.title, 
                                    (SELECT ROUND(AVG (r.grade),2) FROM review r WHERE
                                    r.film_ID = f.film_ID) AS average_grade
                                    FROM film f
                                    JOIN castandcrew c ON f.film_ID = c.film_ID
                                    JOIN actor a ON c.actor_ID = a.actor_ID
                                    WHERE a.actorfirstname = '$actor_firstname' AND a.actorlastname = '$actor_lastname'
                                    ORDER BY average_grade DESC
                                    LIMIT 1");
    if(isset($_POST['show_int9'])){
        
        $actor_firstname = mysqli_real_escape_string($conn, $_POST['form_actor_firstname']);
        $actor_lastname = mysqli_real_escape_string($conn, $_POST['form_actor_lastname']);
        $query_int9= mysqli_query($conn,"SELECT f.title, 
                                        (SELECT ROUND(AVG (r.grade),2) FROM review r WHERE
                                        r.film_ID = f.film_ID) AS average_grade
                                        FROM film f
                                        JOIN castandcrew c ON f.film_ID = c.film_ID
                                        JOIN actor a ON c.actor_ID = a.actor_ID
                                        WHERE a.actorfirstname = '$actor_firstname' AND a.actorlastname = '$actor_lastname'
                                        ORDER BY average_grade DESC
                                        LIMIT 1");
    }

//===========interogare 10=========================================

    $date1 = '';
    $date2 = '';
    $row_int10 = 0;
    $query_int10= mysqli_query($conn,"SELECT COUNT(*) AS num_users
                                    FROM review r
                                    WHERE r.user_ID IN
                                        (
                                            SELECT u.user_ID FROM user u 
                                            JOIN review r ON u.user_ID = r.user_ID 
                                            JOIN film f ON r.film_ID = f.film_ID
                                            JOIN awardedfilm af ON f.film_ID = af.film_ID 
                                            WHERE af.awardeddate BETWEEN '$date1' AND '$date2'
                                        )");
    if(isset($_POST['show_int10'])){
        
        $date1 = mysqli_real_escape_string($conn, $_POST['form_date1']);
        $date2 = mysqli_real_escape_string($conn, $_POST['form_date2']);
        $query_int10= mysqli_query($conn,"SELECT COUNT(*) AS num_users
                                        FROM review r
                                        WHERE r.user_ID IN
                                        (
                                            SELECT u.user_ID FROM user u 
                                            JOIN review r ON u.user_ID = r.user_ID 
                                            JOIN film f ON r.film_ID = f.film_ID
                                            JOIN awardedfilm af ON f.film_ID = af.film_ID 
                                            WHERE af.awardeddate BETWEEN '$date1' AND '$date2'
                                        )");
         $row_int10 = mysqli_fetch_array($query_int10);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Statistic</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">
 
</head>
<body>

<?php include "./menu.php"?>

<div class = "movie-container">
    <h3> Statistic page </h3>
    <hr size="4" width="100%" color="white"><br>
<form action="" method="post" enctype="multipart/form-data">

<!-- ==================afisare interogare 1============================== -->

    <p style = "color: white">Alege userul pentru care vrei sa aflii numarul de review-uri date: 
    <select name="form_users">
            <?php
                while ($row = mysqli_fetch_assoc($result_user)){  
            ?>
            <option value="<?php echo $row['username'];?>">
                <?php echo $row['username'];?> 
            </option>
            <?php
                }
            ?>
    </select> <input type="submit" value="Arata" name="show_int1" class="btn"></p>
    <p style = "color: white">Numarul de review-uri date de userul <b><?php echo $username?></b> este de: <b><?php echo $row_int1['Nr']?></b></p>
   <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 2============================== -->

    <p style = "color: white">Alege filmul pentru care vrei sa aflii numarul de review-uri primite: 
    <select name="form_film">
            <?php
                while ($row = mysqli_fetch_assoc($result_film)){  
            ?>
            <option value="<?php echo $row['title'];?>">
                <?php echo $row['title'];?> 
            </option>
            <?php
                }
            ?>
    </select> <input type="submit" value="Arata" name="show_int2" class="btn"></p>
    <p style = "color: white">Numarul de review-uri date pentru filmul <b><?php echo $title?></b> este de: <b><?php echo $row_int2['Nr']?></b></p>
    <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 3============================== -->

    <p style = "color: white">Numarul de filme care au note intre: 
    <select name="form_grade1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>        
    </select> si 
    <select name="form_grade2">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>        
    </select>
     <input type="submit" value="Arata" name="show_int3" class="btn"></p>
    <p style = "color: white">Numarul de filme cu note intre <b><?php echo $grade1?></b> si <b><?php echo $grade2?></b> este de: <b><?php echo $row_int3['Nr']?></b></p>
    <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 4============================== -->

    <p style = "color: white">Afisarea atat a filmelor care au luat premiul 
    <select name="form_award">
            <?php
                while ($row = mysqli_fetch_assoc($result_award)){  
            ?>
            <option value="<?php echo $row['type'];?>">
                <?php echo $row['type'];?> 
            </option>
            <?php
                }
            ?>
    </select> cat si a datei in care au fost premiate <input type="submit" value="Arata" name="show_int4" class="btn"></p>
    <p style = "color: white">Filmele care au luat premiul <b><?php echo $type?></b> sunt: </p>
    <table class = "int-list">
        <tr>
            <th>Film title</th>
            <th>Award</th>
            <th>Awarded date</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($query_int4) > 0){
            while ($row_int4 = mysqli_fetch_assoc($query_int4))
            {   
            echo "
            <tr>
                <td>".$row_int4['title']."</td>
                <td>".$row_int4['type']."</td>
                <td>".$row_int4['awardeddate']."</td>
            </tr>
            ";
            }
        } 
        ?>   
    </table>
    <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 5============================== -->

 <p style = "color: white">Filmele care au fost premiate inainte de anul
    <input type="text" name="date" class="box">
    <input type="submit" value="Arata" name="show_int5" class="btn"></p>
    <p style = "color: white">Filmele care au fost premiate inainte de anul <b><?php echo $date?></b> sunt: </p>
    <table class = "int-list">
        <tr>
            <th>Film title</th>
            <th>Awarded date</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($query_int5) > 0){
            while ($row_int5 = mysqli_fetch_assoc($query_int5))
            {   
            echo "
            <tr>
                <td>".$row_int5['title']."</td>
                <td>".$row_int5['awardeddate']."</td>
            </tr>
            ";
            }
        } 
        ?>   
    </table>
    <br><hr size="4" width="100%" color="white"><br> 
    
<!-- ==================afisare interogare 6============================== -->

<p style = "color: white">Afisarea atat a filmului cat si a regizorului in care 
    <select name="form_role">
            <?php
                while ($row = mysqli_fetch_assoc($result_role)){  
            ?>
            <option value="<?php echo $row['role'];?>">
                <?php echo $row['role'];?> 
            </option>
            <?php
                }
            ?>
    </select> este personaj <input type="submit" value="Arata" name="show_int6" class="btn"></p>
    <p style = "color: white">Filmul si regizorul in care <b><?php echo $role?></b> este personaj sunt: </p>
    <table class = "int-list">
        <tr>
            <th>Film title</th>
            <th>Actor first name</th>
            <th>Actor last name</th>
            <th>Role</th>
            <th>Director</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($query_int6) > 0){
            while ($row_int6 = mysqli_fetch_assoc($query_int6))
            {   
            echo "
            <tr>
                <td>".$row_int6['title']."</td>
                <td>".$row_int6['actorfirstname']."</td>
                <td>".$row_int6['actorlastname']."</td>
                <td>".$row_int6['role']."</td>
                <td>".$row_int6['director']."</td>
            </tr>
            ";
            }
        } 
        ?>   
    </table>
    <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 7============================== -->

<p style = "color: white">Afisarea userilor inregistrati in baza de date, dar care nu au niciun review dat. 
    <input type="submit" value="Arata" name="show_int7" class="btn"></p>
    <table class = "int-list">
        <tr>
            <th>Username</th>
            <th>User first name</th>
            <th>User last name</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($query_int7) > 0){
            while ($row_int7 = mysqli_fetch_assoc($query_int7))
            {   
            echo "
            <tr>
                <td>".$row_int7['username']."</td>
                <td>".$row_int7['firstname']."</td>
                <td>".$row_int7['lastname']."</td>
            </tr>
            ";
            }
        } 
        ?>   
    </table>
    <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 8============================== -->

<p style = "color: white">Afisarea numarului de review-uri pentru fiecare user. 
    <input type="submit" value="Arata" name="show_int8" class="btn"></p>
    <table class = "int-list">
        <tr>
            <th>User first name</th>
            <th>User last name</th>
            <th>Username</th>
            <th>Number of reviews</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($query_int8) > 0){
            while ($row_int8 = mysqli_fetch_assoc($query_int8))
            {   
            echo "
            <tr>
                <td>".$row_int8['firstname']."</td>
                <td>".$row_int8['lastname']."</td>
                <td>".$row_int8['username']."</td>
                <td>".$row_int8['NrReview']."</td>
            </tr>
            ";
            }
        } 
        ?>   
    </table>
    <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 9============================== -->

    <p style = "color: white">Afisarea filmului cu cea mai mare medie a notelor in care joaca actorul 
    <select name="form_actor_firstname">
            <?php
                while ($row1 = mysqli_fetch_assoc($result_actor1)){  
            ?>
            <option value="<?php echo $row1['actorfirstname'];?>">
                <?php echo $row1['actorfirstname'];?> 
            </option>
            <?php
                }
            ?>
    </select> 
    <select name="form_actor_lastname">
            <?php
                while ($row2 = mysqli_fetch_assoc($result_actor2)){  
            ?>
            <option value="<?php echo $row2['actorlastname'];?>">
                <?php echo $row2['actorlastname'];?> 
            </option>
            <?php
                }
            ?>
    </select> 
    <input type="submit" value="Arata" name="show_int9" class="btn"></p>
    <p style = "color: white">Filmul cu cea mai mare medie a notelor in care joaca actorul <b><?php echo $actor_firstname?></b> <b><?php echo $actor_lastname?></b> este:</p>
    <table class = "int-list">
        <tr>
            <th>Film title</th>
            <th>Average</th>
        </tr>
        
        <?php
        if (mysqli_num_rows($query_int9) > 0){
            while ($row_int9 = mysqli_fetch_assoc($query_int9))
            {   
            echo "
            <tr>
                <td>".$row_int9['title']."</td>
                <td>".$row_int9['average_grade']."</td>
            </tr>
            ";
            }
        } 
        ?>   
    </table>
    <br><hr size="4" width="100%" color="white"><br>

<!-- ==================afisare interogare 10============================== -->

    <p style = "color: white">Numarul de useri care au dat review la filme premiate intre data  
    <input type="date" name="form_date1" class="box"> si date
    <input type="date" name="form_date2" class="box">
    <input type="submit" value="Arata" name="show_int10" class="btn"></p>
    <p style = "color: white">Numarul de useri care au dat review la filme premiate intre data <b><?php echo $date1?></b> si <b><?php echo $date2?></b> este: <b><?php echo $row_int10['num_users']?></b></p>
    
    <br><hr size="4" width="100%" color="white"><br>
</form>
</div>
</body>
</html>