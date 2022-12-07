<?php 
  session_start();
  require 'connect.php';
  
  if(!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
  }

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
  }

  $no = 0;

  $result = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '".$_SESSION['id']."'");
  $row = mysqli_fetch_assoc($result);

  $result2 = mysqli_query($conn, "SELECT * FROM games");

  if(isset($_POST['tambahData'])){
    $id = hexdec(uniqid());
    $judul = $_POST['title'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if( $error === 4 ) {
      echo "<script>
          alert('pilih gambar terlebih dahulu!');
          </script>";
      header("Location: beranda.php");
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
      echo "<script>
          alert('yang anda upload bukan gambar!');
          </script>";
    }

    if( $ukuranFile > 1000000 ) {
      echo "<script>
          alert('ukuran gambar terlalu besar!');
          </script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'gameImg/' . $namaFileBaru);

    $insert = mysqli_query($conn, "INSERT INTO games (`id_game`, `judul`, `genre`, `price`, `image`) 
                                    VALUES ('$id', '$judul', '$genre', '$price', '$namaFileBaru');");
    
    if($insert){
      echo "<script>alert('Data Berhasil Ditambah!')</script>";
    } else {
      echo "<script>alert('Data Gagal Ditambah!')</script>";
    }
    header("Location: beranda.php");
    exit;
  }
  
  if(isset($_POST['ubahData'])){
    $id = $_POST['id'];
    $judul = $_POST['title'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $gambarLama = $_POST['gambarLama'];

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
      $gambar = $gambarLama;
    } else {
      //hapus gambar
      $deleteGambarPath = "gameImg/".$gambarLama;
      unlink($deleteGambarPath);

      $namaFile = $_FILES['gambar']['name'];
      $ukuranFile = $_FILES['gambar']['size'];
      $error = $_FILES['gambar']['error'];
      $tmpName = $_FILES['gambar']['tmp_name'];

      if( $error === 4 ) {
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
            </script>";
        header("Location: beranda.php");
      }

      $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
            alert('yang anda upload bukan gambar!');
            </script>";
      }

      if( $ukuranFile > 1000000 ) {
        echo "<script>
            alert('ukuran gambar terlalu besar!');
            </script>";
      }

      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensiGambar;

      move_uploaded_file($tmpName, 'gameImg/' . $namaFileBaru);

      $gambar = $namaFileBaru;
    }
    
    $update = mysqli_query($conn, "UPDATE `games` SET `judul` = '$judul', `genre` = '$genre', 
                                  `price` = '$price', `image` = '$gambar' WHERE `id_game` = '$id';");

    if($update){
      echo "<script>alert('Data Berhasil Diubah!')</script>";
    } else {
      echo "<script>alert('Data Gagal Diubah!')</script>";
    }
    header("Location: beranda.php");
    exit;
  }

  if(isset($_POST['hapusData'])){
    $id = $_POST['id'];
    $delete = mysqli_query($conn, "DELETE FROM games WHERE `id_game` = '$id'");
    $gambarLama = $_POST['gambarLama'];
    $deleteGambarPath = "gameImg/".$gambarLama;
    unlink($deleteGambarPath);
    if($update){
      echo "<script>alert('Data Berhasil Dihapus!')</script>";
    } else {
      echo "<script>alert('Data Gagal Dihapus!')</script>";
    }
    header("Location: beranda.php");
    exit;
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
    <script src=""></script>
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
            <a class="nav-link active" aria-current="page" href="#">Game</a>
            <?php
              if($_SESSION['role'] === "ADMIN") {
                echo "<a type='button' class='nav-link' data-bs-toggle='modal' data-bs-target='#tambahGame'>Add Game</a>";
              } else {
                echo "<a class='nav-link' href='mygames.php'>My Games</a>";
              }
            ?>
            <a class="nav-link" href="aboutUs.php">About Us</a>
            <a class="nav-link" href="logout.php">Log Out</a>
          </div>
        </div>
      </div>
  </nav>
  <header class="py-5 border-bottom mb-4">
      <div class="container">
          <div class="text-center mt-5">
              <h1 class="fw-bolder text-dark">Welcome Back <?php echo $row['nama']; ?></h1>
          </div>
      </div>
  </header>
  <div class="container">
    <form id="searchForm" action="" method="POST">
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="keyword" placeholder="Seach">
        <button type="submit" class="btn btn-outline-secondary" name="cari">Search</button>
      </div>
    </form>
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 g-4" id="Games">
        <?php
          while($game = mysqli_fetch_assoc($result2)){
            $no++;
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
            <?php 
              if($_SESSION['role'] === "ADMIN") {
            ?>
            <div class="card-body text-center">
              <a type="button" class="btn btn-warning w-25" data-bs-toggle='modal' data-bs-target='#editGame<?= $no ?>'>Edit</a>
              <a type="button" class="btn btn-danger w-50" data-bs-toggle='modal' data-bs-target='#hapusGame<?= $no ?>'>Delete</a>
            </div>

            <!-- Awal Modal Ubah -->
            <div class="modal fade" id="editGame<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Game</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="submitForm" action="" method="POST" name="form1" enctype="multipart/form-data">
                      <input type="hidden" name="gambarLama" value="<?= $game['image'] ?>">
                      <table width="100%" class="table" >
                          <tr>
                              <td>id</td>
                              <td><input type="text" readonly class="form-control" name="id" value="<?= $game['id_game'] ?>"></td>
                          </tr>
                          <tr>
                              <td>Title</td>
                              <td><input type="text" class="form-control" name="title" value="<?= $game['judul'] ?>"></td>
                          </tr>
                          <tr>
                              <td>Genre</td>
                              <td><input type="text" class="form-control" name="genre" value="<?= $game['genre'] ?>"></td>
                          </tr>
                          <tr>
                              <td>Price</td>
                              <td><input type="number" class="form-control" name="price" value="<?= $game['price'] ?>"></td>
                          </tr>
                          <tr>
                              <td>Image</td>
                              <td><input type="file" class="form-control" name="gambar"></td>
                          </tr>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" onclick="reset()">Reset</button>
                      <button type="submit" class="btn btn-primary" name="ubahData">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Akhir Modal Ubah -->

            <!-- Awal Modal Hapus -->
            <div class="modal fade" id="hapusGame<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="submitForm" action="" method="POST" name="form1" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?= $game['id_game'] ?>">
                      <input type="hidden" name="gambarLama" value="<?= $game['image'] ?>">
                      <h5 class="text-center text-dark">Apakah anda yakin akan menghapus data ini <br>
                        <span class="text-danger"><?= $game['id_game']?> - <?= $game['judul']?></span>
                      </h5>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger" name="hapusData">Delete</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Akhir Modal Hapus -->

            <?php
              } else {
            ?>
            <div class="card-body text-center">
              <a href="#" class="btn btn-primary w-100" onclick="confirmation(<?= $game['id_game'] ?>)">Buy</a>
            </div>
            <?php
              }
            ?>
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

  <!-- Awal Modal -->
  <div class="modal fade" id="tambahGame" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form Game</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="submitForm" action="" method="POST" name="form1" enctype="multipart/form-data">
            <table width="100%" class="table" >
                <tr>
                    <td>Title</td>
                    <td><input type="text" class="form-control" name="title"></td>
                </tr>
                <tr>
                    <td>Genre</td>
                    <td><input type="text" class="form-control" name="genre"></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" class="form-control" name="price"></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" class="form-control" name="gambar"></td>
                </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="reset()">Reset</button>
            <button type="submit" class="btn btn-primary" name="tambahData">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Akhir Modal -->
<script src="js/bootstrap.bundle.js"></script>
</body>
</html>

<script type="text/javascript">
  function confirmation (id_game) {
    if (confirm('Apakah anda yakin akan membeli game ini?')){
      window.location.href = 'aksi_buy.php?id_game='+id_game;
    }
  }
</script>