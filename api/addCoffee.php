<?php
header('Content-Type: application/json');
include 'dbconfig.php';

// Ambil data JSON dari POST request
$data = json_decode(file_get_contents("php://input"));

$namaCoffee = $data->namaCoffee;
$kategori = $data->kategori;
$deskripsi = $data->deskripsi;
$makananPelengkap = $data->makananPelengkap;

$sql = "INSERT INTO coffeedrinknote (nama, kategori, deskripsi, makanan_pelengkap) VALUES ('$namaCoffee', '$kategori', '$deskripsi', '$makananPelengkap')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "New coffee added"]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>
