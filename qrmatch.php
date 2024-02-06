<?php
include "connect.php";
// Step 1: Scan a QR Code and prepare its data
$scannedQRCodeData = "text"; // Replace with your QR code scanning logic
$encodedScannedData = base64_encode($scannedQRCodeData);



// Step 3: Query the Database
$sql = "SELECT qrcode FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Step 4: Compare the Scanned QR Code
        $databaseQRCodeData = $row['qrcode'];

        if ($encodedScannedData === $databaseQRCodeData) {
            echo "QR Code Matched!";
            break;
        }
    }
} else {
    echo "No QR Codes found in the database.";
}

$conn->close();
?>
