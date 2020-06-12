<?php
include_once 'config.php';

$username = $password = $confirm_password = " ";

$username_err = $password_err = $confirm_password_err = "";

if($_SERVER['REQUEST_METHOD']== "POST"){

    if(empty(trim($_POST['username']))){
        $username_err="username cannot be blank";

    }else{
        $sql= "select id from users where username = ?";
        $stmt = mysqli_prepare($conn , $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt,'s', $param_username);

            $param_username = trim($_POST['username']);

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)== 1){
                    $username_err = "This username already taken ";

                }else{
                    $username= trim($_POST['username']);
                }

            }else{
                echo "smthing went wrong";
            }
        }
          



    }

     mysqli_stmt_close($stmt);
    


//password
if(empty(trim($_POST['password']))){
    $password_err = "password cannot be blank";
    }elseif(strlen(trim($_POST['password']))<5){
           $password_err = "password should be grater than 5 characters  ";
         
    }else{
          $password = trim($_POST['password']);

    }

//confirm password
if(trim($_POST['password']) != trim($_POST['confirm_password'])){
    $confirm_password_err = "password doesent match ";

}

//if no errors
if(empty($username_err) && empty($password_err)&& empty($confirm_password_err)){
    $sql= "insert into users (username , password ) values (?,?);";
    $stmt = mysqli_prepare($conn , $sql);
    if($stmt){
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

       //set parameter
       $param_username= $username;

       $param_password= password_hash($password,PASSWORD_DEFAULT);

       //EXECUTE QUERY
       if(mysqli_stmt_execute($stmt)){

        header("Location: login.php");
       }else{
           echo "smthing went wrong";
       }
        
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);

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

    <title>REGISTER</title>
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
        <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">ABOUT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">CONTACTS</a>
      </li>
      
    </ul>
  </div>
</nav>

<div class="container mt-4">
    <center>
<h1>REGISTER HERE</h1>
</center>
<hr>                                                

<form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">USERNAME</label>
      <input type="text" name="username"  class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword4">
    </div>
  </div>
  <div class="form-group ">
      <label for="inputPassword4"> Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control" id="inputPassword">
    </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>


      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>