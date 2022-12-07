<?php 
require 'connect.php';

if(isset($_POST['register'])){
  $result = mysqli_query($conn, "SELECT * FROM user");
  $num = mysqli_num_rows($result);
  $id = "USER";
  $id .= $num;
  $nama = $_POST['name'];
  $gender = $_POST['optradio'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $pass1 = $_POST['password1'];
  $pass2 = $_POST['password2'];
  $know = $_POST['know'];
  $message = $_POST['pesan'];

  if($pass1 == $pass2){
    mysqli_query($conn, "INSERT INTO user VALUES('$id', '$nama', '$email', '$pass2', '$gender', '$address', '$know', '$message', 'USER');");
    header("Location: index.php");
    exit;
  } else {
    echo "<script>alert('Samakan kedua input password');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Register</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
    <form class="mx-1 mx-md-4" action="registrasion.php" method="POST">
  
      <div class="d-flex flex-row align-items-center mb-2">
        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-1">
        <label class="form-label" for="form3Example1c">Your Name</label>
        <input type="text" id="form3Example1c" name="name" class="form-control" />
      </div>
      </div>

      <div class="d-flex flex-row align-items-center mb-2">
        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
        <label class="form-check-label" for="radio1">Gender</label>
      </div>      
                       
      <div class="d-flex flex-row align-items-center mb-2">
        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i> 
      <div class="form-outline flex-fill">
        <input class="form-check-input" type="radio" name="optradio" id="radio1" value="P" />
        <label class="form-check-label" for="radio1">Female</label>
        <input class="form-check-input" type="radio" name="optradio" id="radio2" value="L"/>
        <label class="form-check-label" for="radio2">Male</label>
      </div>
      </div>

      <div class="d-flex flex-row align-items-center mb-2">
        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
          <label class="form-label" for="form3Example3c">Your Address</label>
          <input type="address" id="form3Example3c" name="address" class="form-control" />
      </div>
      </div>

    <div class="d-flex flex-row align-items-center mb-2">
      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
    <div class="form-outline flex-fill mb-0">
      <label class="form-label" for="form3Example3c">Your Email</label>
      <input type="email" id="form3Example3c" name="email" class="form-control" />
    </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-2">
      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
    <div class="form-outline flex-fill mb-0">
      <label class="form-label" for="form3Example4c">Password</label>
      <input type="password" id="form3Example4c" name="password1" class="form-control" />
    </div>
    </div>
  
    <div class="d-flex flex-row align-items-center mb-2">
      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <label class="form-label" for="form3Example4cd">Repeat your password</label>
        <input type="password" id="form3Example4cd" name="password2" class="form-control" />
      </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-3">
      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
    <div class="form-outline flex-fill mb-0">
        <label class="form-label" for="form3Example1n1">Mengetahui Web ini dari mana</label>
    <div class="form-outline">
        <select class="select" name="know">
          <option value="Web">Web</option>
          <option value="Surat Kabar">Surat Kabar</option>
          <option value="Teman">Teman Kerabat</option>
          <option value="Internet">Browsing Internet</option>
        </select>
    </div>
    </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-1">
      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-4">
        <label class="form-label" for="form3Example1n1">Pesan</label>
        <div class="form-outline">
          <textarea name="pesan" id="" cols="38" rows="2"></textarea>
        </div>
      </div>
    </div>
            
    <div class="d-flex mx-3 mb-2 mb-lg-2">
      <button type="button" onclick="reset()" class="btn btn-light btn-lg ">Reset</button>
      <button type="submit" name="register" class="btn btn-primary btn-lg ms-2">Register</button>
    </div>
  
  </form>
  
    </div>
    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
        <img src="xbox-bethesda-e3-halo-infinite-redfall-starfield.webp" class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
</body>
</html>

