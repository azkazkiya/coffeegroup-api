<?php
header('Content-Type: application/json');
include 'dbconfig.php';

$sql = "SELECT * FROM coffeedrinknote";
$result = $conn->query($sql);

$coffees = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $coffees[] = $row;
    }
}

echo json_encode($coffees);
$conn->close();
?>
