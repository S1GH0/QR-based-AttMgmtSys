<?php
include "connect.php";
$imageId = isset($_GET['id'])  ; // ? $_GET['name'] : ''

if (empty($imageId)) {
    die("Image identifier not provided.");
}

// Fetch the image data from the database
$sql = "SELECT qrcode FROM students Where id =?"; // Change to your actual query

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}

//$id = 'BCA33'; // Change to the ID of the image you want to display
$stmt->bind_param("s", $imageId);
$stmt->execute();
$stmt->bind_result($qrcode);
$stmt->fetch();
$stmt->close();

// Set the appropriate content type header for image display
header('Content-Type: image/png'); // Change to the appropriate image type (e.g., image/png for PNG images)

// Output the binary image data
echo $qrcode;

// Close the database connection
$conn->close();
?>
