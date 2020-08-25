<?php

$inserted=false;
$passNotMatch=false;
$mail=null;

if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'parts/dbconnect.php';
  $mail=$_POST["mail"];
  $password=$_POST["pass"];
  $cpassword=$_POST["cpass"];

  if($password==$cpassword){
    $hash_pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `wn_userdata` (`mail`, `pass`) VALUES ('$mail', '$hash_pass')";

    $result=mysqli_query($conn,$sql);
    if($result){
      $inserted=true;
    }
  } else{
    $passNotMatch=true;
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Signup Page</title>
  </head>
  <body>
  <?php include "parts/navbar.php"?>
  <?php

  if($inserted){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Account Created!</strong> Now you can login.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }

  if($passNotMatch){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Password & confirm password not matched.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }

  ?>
  <div class="container">
  <form action="signup.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="pass" name="pass">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="cpass" name="cpass">
  </div>
  <button type="submit" class="btn btn-primary">Signup</button>
</form>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

<?php
$ar=explode("@",$mail);
$name=$ar[0];
if($inserted){
  $sql="CREATE TABLE `web_note`.`$name` ( `title` VARCHAR(25) NOT NULL , `note` TEXT NOT NULL ) ENGINE = InnoDB";
  mysqli_query($conn,$sql);
}

?>