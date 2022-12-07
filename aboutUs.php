<?php
session_start();
if(!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="style2.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">Game Store</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link" href="beranda.php">Game</a>
              <?php
                if($_SESSION['role'] === "ADMIN") {
                  echo "<a class='nav-link' href='data.php'>Add Game</a>";
                } else {
                  echo "<a class='nav-link' href='mygames.php'>My Games</a>";
                }
              ?>
              <a class="nav-link active" href="#">About Us</a>
              <a class="nav-link" href="logout.php">Log Out</a>
            </div>
          </div>
        </div>
    </nav>
    <h1 class="margin">About Us</h1>
    <div class="row">
        <div class="column">
            <p>Game mempunyai banyak manfaat yaitu dapat membantu manusia dalam menghilangkan kepenatan atau mengisi waktu luang. Selain itu sebagai sarana penghibur, hobi, ataupun menjadi ajang bisnis yang dapat menghasilkan sejumlah uang.<br><br>
            Game itu sendiri dibagi menjadi 2 golongan yaitu game online dan game offline. Disini kami dari kelompok 3 mendapatkan inspirasi untuk membuat sebuah toko game berbasis web, yang nantinya akan membantu user di toko game dalam menjalankan usahanya yaitu menggunakan web. Biasanya pemilik toko memiliki kendala dalam menjual game dan produk di toko mereka karena kurangnya media untuk mempromosikan game atau produk- produk yang ada di toko.
            </p>
        </div>
        <div class="column" >
          
          <p>Game berbasis web tersebut mempunyai fungsi, yaitu sebagai sarana dan prasaran mediator bagi toko game dalam menjual atau mempromosikan produk-produk yang ada di toko ke seluruh masyarakat melalui web yang akan dibuat. Di dalam web tersebut para calon pembeli akan dapat melihat dan memesan game atau produk yang diinginkan. Dengan demikian, hal ini dapat menunjang penjualan pada toko game tersebut.</p>
        </div>
      </div>
        <b> <h3>KELOMPOK 3</h3></b>
        <b> <h3>PTIK_E 2020</h3></b>
       
        <table>
            <tr>
            <td> 
                <center>
                    <b><p>Agil Fikriawan</p>200209502011</b>
                </center>
               
                <a href="About_Us/artikel_Agil.html" target="About_Us/artikel_Agil.html" rel="nofollow" width="250px" height="200px"><img src="About_Us/Foto_Agil.jpg" alt="Agil" title="Agil"></a>
            </td>
            <td> 
                <center>
                    <b> <p>Mukhlisah</p>200209502061</b>
                   
                </center>
           
            <a href="About_Us/artikel_Mukhlisah.html" target="About_Us/artikel_Mukhlisah.html" rel="nofollow" width="250px" height="200px"><img src="About_Us/Foto Mukhlisah.jpeg" alt="Lisa" title="Lisa"></a>
            </td>
            <p></p>
            <tr>
            <td> 
                <center>
                    <b> <p>Muh Dzaky Fazary Thalib</p>200209502075</b>
                   
                </center>
           
            <a href="About_Us/artikel_Dzaky.html" target="About_Us/artikel_Dzaky.html" rel="nofollow" width="250px" height="200px"><img src="About_Us/Dzaki.jpeg" alt="Agil" title="Dzaki"></a>
            </td>
            
            <td> 
                <center>
                    <b><p>Indah Wulan Sari</p>200209500036</b>
                    
                </center>
               
                <a href="About_Us/artikel_Indah.html" target="About_Us/artikel_Indah.html" rel="nofollow" width="250px" height="200px"><img src="About_Us/indah.jpeg" alt="Indah" title="Indah"></a>
            </td>
            <tr>
            </table>
            
</body>
</html>