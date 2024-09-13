<?php 
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

$konfigs = mysqli_connect("localhost", "root", "", "klinik") or mysqli_connect_error();

try {
    $config = new PDO("mysql:host=localhost;dbname=klinik;", "root", "");
} catch (Exception $e){
    die("Database Gagal terhubung : ".$e->getMessage());
}

?>