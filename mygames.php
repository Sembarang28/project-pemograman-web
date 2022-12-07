<?php
  session_start();
  require 'connect.php';

  if(!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
  }

  $result = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '".$_SESSION['id']."'");
  $row = mysqli_fetch_assoc($result);

  $result2 = mysqli_query($conn, "SELECT c.judul, c.genre, c.price, c.image FROM details a 
                            INNER JOIN user b ON a.id_user = b.id_user INNER JOIN games c ON a.id_games = c.id_game 
                            WHERE b.id_user = '".$_SESSION['id']."';");

  function rupiah($angka){
      $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
      return $hasil_rupiah;
  }

  if(isset($_POST['cari'])){
    $search = $_POST['keyword'];
    $result2 = mysqli_query($conn, "SELECT * FROM games WHERE judul LIKE '%$search%' OR genre LIKE '%$search%' OR price LIKE '%$search%' OR image LIKE '%$search%';");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Game Store</title>
</head>
<body class="font">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Game Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link" aria-current="page" href="beranda.php">Game</a>
            <a class='nav-link active' href='#'>My Games</a>
            <a class="nav-link" href="aboutUs.php">About Us</a>
            <a class="nav-link" href="logout.php">Log Out</a>
          </div>
        </div>
      </div>
  </nav>
  <header class="py-5 border-bottom mb-4">
      <div class="container">
          <div class="text-center my-5">
              <h1 class="fw-bolder text-dark">My Games</h1>
          </div>
      </div>
  </header>
  <div class="container">
    <form id="searchForm" action="" method="POST">
      <div class="input-group mb-3">
        <label for="inputSearch"></label>
        <input type="text" class="form-control" id="inputSearch" name="keyword" placeholder="Seach">
        <button class="btn btn-outline-secondary" type="submit" name="cari" id="searchSubmit">Search</button>
      </div>
    </form>
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 g-4" id="Games">
        <?php
          while($game = mysqli_fetch_assoc($result2)){
        ?>
        <div class="col">
          <div class="card">
            <img src="gameImg/<?php echo $game['image']; ?>" class="card-img-top" height="300px">
            <div class="card-body">
              <h5 class="card-title text-center text-dark"><?php echo $game['judul']; ?></h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><?php echo $game['genre']; ?></li>
              <li class="list-group-item"><?php echo rupiah($game['price']); ?></li>
            </ul>
            <div class="card-body text-center">
              <a href="#" class="btn btn-primary w-100">Play</a>
            </div>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
  <footer class="py-4 bg-dark mt-5">
    <div class="container"><p class="m-0 text-center text-white">Kelompok 3 &copy; 2022</p></div>
  </footer>
</body>
</html>