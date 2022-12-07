<?php 
session_start();
require 'connect.php';

//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])){
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id'");
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) === 1){
    if ($key === hash('sha256', $row['email'])){
      $_SESSION['login'] = true;
      $_SESSION['id'] = $row['id_user'];
      $_SESSION['role'] = $row['role'];
    }
  }
}

if (isset($_SESSION['login'])){
  header("Location: beranda.php");
  exit;
}

if (isset($_POST['login'])){
  $email = $_POST['inputEmail'];
  $password = $_POST['inputPassword'];
  
  $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND password = '$password'");
  
  //Membuat Session
  if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['login'] = true;
    $_SESSION['id'] = $row['id_user'];
    $_SESSION['role'] = $row['role'];
    
    //Cek remember me
    if (isset($_POST['remember'])){
      //Buat cookie
      setcookie('id', $row['id_user'], time()+3600);
      setcookie('key', hash('sha256', $row['email']), time()+3600);
    }
    
    //Menuju halaman beranda
    header("Location: beranda.php");
    exit;
  } else {
    echo "<script>alert('Email atau Password salah!')</script>";
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--css-->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
  </head>
  <body>
 
    <nav class="navbar navbar-dark bg-dark m-0 p-3 mb-0">
    <div class="container">
    <span class="navbar-brand  mb-0 h1">GAME STORE</span>
    <!--Button Login dan Registrasi-->
    <button type="button" class="btn  ms-auto text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">LOGIN</button>
    <a type="button" href='registrasion.php' class="btn text-white">REGISTRASI</a>
    <!--Modal Login-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-black m-1">
            <h1 class="modal-title fs-1" id="exampleModalLabel">LOGIN</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" name="inputEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" name="inputPassword" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                    <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Ingat Saya</label>
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                  </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
    <div class="container-fluid banner">
    <div class="container text-center">
         <h1 class="display-1">WELCOME TO OUR WEBSITE</h1>
    </div>
    </div>

  <!--Slider-->
  <div class="container-fluid carousel-contain py-5">
    <div class="container ">
        <h2 class="text-center">GET IT SOON</h2>
        <div id="carouselExampleInterval" class="carousel slide col-lg-6 offset-lg-3" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="fifa.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="pubg.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="minecraft.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
  </div>

  <!--Footer-->
  <div class="container-fluid footer py-5">
    <div class="container ">
        <h3 class="text-center">HAVE FUN AND ENJOY</h3>
    </div>
  </div>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>

  </body>
</html>