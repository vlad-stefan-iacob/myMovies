<?php

@include 'config.php'; //conectarea la baza de date

session_start();

if(isset($_POST['submit'])){

   //obtinerea datelor completate in formularul de login
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   //verificarea ca datele exista in baza de date 
   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      $_SESSION['home_page_name'] = $row['username'];
      $_SESSION['user_id'] = $row['user_ID'];
      header('location:home_page.php');
   }
   else{
      $error[] = 'Incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login page</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>LOGIN</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <!-- formularul pentru completarea datelor in fereastra de login -->
      <input type="email" name="email" required placeholder="Your email">
      <input type="password" name="password" required placeholder="Your password">
      
      <input type="submit" name="submit" value="Login" class="form-btn">
      <p>Do not have an account? <a href="register_form.php">Register now</a></p>
   </form>

</div>

</body>
</html>