<?php
// koneksi.php

// KREDENSIAL INFINITYFREE
$host = "sql308.infinityfree.com"; 
$username = "if0_40658673"; 
$password = "zpKpYVKVTquU"; // Ganti dengan password cPanel/VPanel kamu
$database = "if0_40658673_findevent"; 

// JANGAN UBAH BAGIAN INI
$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>