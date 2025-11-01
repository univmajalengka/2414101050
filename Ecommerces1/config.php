<?php

$servername = "localhost";
$username = "tugaspabw_2414101050";
$password = "REZA2414101050_";
$dbname = "tugaspabw_2414101050";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    
    die("Koneksi Gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>