<?php

session_start();

if(isset($_SESSION['username'])){

  header("Location: home.php");
  exit;
}
require_once "config.php";

$username=$password="";

$err="";

if($_SERVER['REQUEST_METHOD']== 'POST'){


if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){

  $err = "Check username and password";

}else{

  $username=trim($_POST['username']);
  $password=trim($_POST['password']);
}

if(empty($err)){

  $sql = "select id ,username, password from users where username = ? ";
   
  $stmt=  mysqli_prepare($conn , $sql);

  mysqli_stmt_bind_param($stmt, "s" , $param_username );
  $param_username = $username;

  if(mysqli_stmt_execute($stmt)){
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt)==1){
      
       mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
       if(mysqli_stmt_fetch($stmt)){
         if(password_verify($password,$hashed_password)){

                     //allow to login
                     session_start();
                     $_SESSION["username"]= $username;
                     $_SESSION["id"]= $id;
                     $_SESSION["loggedin"]= true; 

                     //redirect
                     header("Location: home.php");

         }

       }

       

    }



  }



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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>login</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">NRITYAM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="./home.php">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./regiter.php">REGISTER</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">CONTACTS</a>
      </li>
      
    </ul>
  </div>
</nav>

<div class="container mt-4">
    <center>
<h1>LOGIN HERE</h1>
</center>
<hr>                                                
<form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">USERNAME</label>
    <input type="text"  name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>