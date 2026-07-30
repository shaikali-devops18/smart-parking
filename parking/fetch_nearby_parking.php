<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking";
Session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userLat = $_POST['latitude'];
$userLng = $_POST['longitude'];
$radius = 10; // Radius in kilometers

$sql = "SELECT id, image, pname, address, area, price, 
        ( 6371 * acos( cos( radians($userLat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($userLng) ) + sin( radians($userLat) ) * sin( radians( latitude ) ) ) ) AS distance 
        FROM parking_area 
        HAVING distance < $radius 
        ORDER BY distance";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $encoded_address = urlencode($row["address"]);
        $maps_link = "https://www.google.com/maps/search/?api=1&query={$encoded_address}";
        echo "<tr>";
        echo "<td width='300px'><img src='image/" . $row["image"] . "' alt='Parking Image'></td>";
        echo "<td>" . $row["pname"] . "</td>";
        echo "<td><a href='$maps_link' target='_blank'>" . $row["address"] . "</a></td>";
        echo "<td>" . $row["area"] . "</td>";
        echo "<td> &#8377 " . $row["price"] . " / Hour</td>";
        echo "<td> <a href='book_parking.php?id=" . $row["id"] . "' class='btn-book'>Book Now</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No nearby parking areas found</td></tr>";
}

$conn->close();
?>
