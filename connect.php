<?php

$conn = mysqli_connect("localhost", "root", "", "gamestore");

//cek koneksi
if(mysqli_connect_errno()){
    echo "Koneksi database mysqli gagal!!! : ".mysqli_connect_error();
}

?>