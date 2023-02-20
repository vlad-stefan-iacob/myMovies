<?php

@include 'config.php'; //conectarea la baza de date

session_start();

$user_id = $_SESSION['user_id']; //obtinerea ID-ului userului conectat

if(isset($_POST['update_profile'])){
   //obtinerea datelor din formularul de update 
    $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
    $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
    $update_username = mysqli_real_escape_string($conn, $_POST['update_username']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);

    //actualizarea datelor din baza de date din tabela USER
    mysqli_query($conn, "UPDATE `user` SET firstname = '$update_firstname', lastname = '$update_lastname', 
    username = '$update_username', email = '$update_email', phone = '$update_phone' WHERE user_ID = '$user_id'");

   //obtinerea parolei din formularul de update 
    $old_pass = $_POST['old_pass'];
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   
    //verificarea parolei ca a fost introdusa corect
    if(!empty($update_pass) || !empty($new_pass)){
        if($update_pass != $old_pass){
            $message_not_ok[] = 'Old password not matched!';
        }else{
            //actualizarea parolei din tabela USER
            mysqli_query($conn, "UPDATE `user` SET password = '$new_pass' WHERE user_ID = '$user_id'");
            $message_ok[] = 'Profile updated successfully!';
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit profile</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include "./menu.php"?>

<div class="update-profile">

   <?php
      //obtinerea datelor din tabela USER pentru precompletarea campurilor din formular
      $select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_ID = '$user_id'");
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>EDIT PROFILE</h3>
      <?php
         if(isset($message_ok)){
            foreach($message_ok as $message_ok){
               echo '<div class="message_ok">'.$message_ok.'</div>';
            }
         }
         if(isset($message_not_ok)){
            foreach($message_not_ok as $message_not_ok){
               echo '<div class="message_not_ok">'.$message_not_ok.'</div>';
            }
         }
      ?>
      <!-- formularul de actualizare al datelor profilului utilizatorului -->
      <div class="flex">
         <div class="inputBox">
            <span>Your firstname :</span>
            <input type="text" name="update_firstname" value="<?php echo $fetch['firstname']; ?>" class="box">
            <span>Your lastname :</span>
            <input type="text" name="update_lastname" value="<?php echo $fetch['lastname']; ?>" class="box">
            <span>Your username :</span>
            <input type="text" name="update_username" value="<?php echo $fetch['username']; ?>" class="box">
         </div>
         <div class="inputBox">
            <span>Your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Your phone :</span>
            <input type="text" name="update_phone" value="<?php echo $fetch['phone']; ?>" class="box">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>Old password :</span>
            <input type="password" name="update_pass" placeholder="Your previous password" class="box">
            <span>New password :</span>
            <input type="password" name="new_pass" placeholder="Your new password" class="box">
         </div>
      </div>
      <input type="submit" value="Update profile" name="update_profile" class="btn">
      <a href="home_page.php" class="back-btn"><i class='fa fa-undo' aria-hidden='true'></i> Back</a>
   </form>

</div>

</body>
</html>