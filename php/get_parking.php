<?php
include 'db_connect.php';

$sql = "SELECT * FROM parking_slots";
$result = $conn->query($sql);

$slots = [];
while($row = $result->fetch_assoc()) {
    $slots[] = $row;
}

echo json_encode($slots);
$conn->close();
?>