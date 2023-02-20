<?php

@include 'config.php'; //conectarea la baza de date

if(isset($_POST['submit'])){

   //obtinerea datelor din formularul de inregistrare
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   //se verifica daca nu mai exista acest utilizator in baza de date
   if(mysqli_num_rows($result) > 0){

      $error[] = 'User already exists!';

   }else{
      //daca nu mai exista atunci se insereaza datele in baza de date in tabela USER
         $insert = "INSERT INTO user(firstname, lastname, username, email, phone, password) VALUES('$firstname','$lastname','$username','$email','$phone', '$pass')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register page</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>REGISTER</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <!-- formularul de inregistrare -->
      <input type="text" name="firstname" required placeholder="Your first name">
      <input type="text" name="lastname" required placeholder="Your last name">
      <input type="text" name="username" required placeholder="Your username">
      <input type="email" name="email" required placeholder="Your email">
      <input type="phone" name="phone" required placeholder="Your phone number">
      <input type="password" name="password" required placeholder="Your password">

      <input type="submit" name="submit" value="Register" class="form-btn">
      <p>Have an account? <a href="login_form.php">Login now</a></p>
   </form>

</div>

</body>
</html>