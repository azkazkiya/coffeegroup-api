<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Koneksi ke database
$conn = new mysqli("localhost", "username", "password", "dbcoffeedrinknote");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk membaca data
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM coffee_table");
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

// Fungsi untuk menambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['Nama'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $makanan_pelengkap = $_POST['makanan_pelengkap'];

    $query = "INSERT INTO coffee_table (Nama, deskripsi, kategori, makanan_pelengkap) VALUES ('$nama', '$deskripsi', '$kategori', '$makanan_pelengkap')";
    
    if ($conn->query($query) === TRUE) {
        echo json_encode(["message" => "Data berhasil ditambahkan"]);
    } else {
        echo json_encode(["message" => "Gagal menambahkan data"]);
    }
}

// Fungsi untuk mengupdate data
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'];
    $nama = $_PUT['Nama'];
    $deskripsi = $_PUT['deskripsi'];
    $kategori = $_PUT['kategori'];
    $makanan_pelengkap = $_PUT['makanan_pelengkap'];

    $query = "UPDATE coffee_table SET Nama='$nama', deskripsi='$deskripsi', kategori='$kategori', makanan_pelengkap='$makanan_pelengkap' WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo json_encode(["message" => "Data berhasil diperbarui"]);
    } else {
        echo json_encode(["message" => "Gagal memperbarui data"]);
    }
}

// Fungsi untuk menghapus data
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];
    $query = "DELETE FROM coffee_table WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo json_encode(["message" => "Data berhasil dihapus"]);
    } else {
        echo json_encode(["message" => "Gagal menghapus data"]);
    }
}

$conn->close();
?>
