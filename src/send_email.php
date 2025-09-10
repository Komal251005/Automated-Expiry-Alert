<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Make sure your PHPMailer is installed here

$owner_email = "handebhagyashri123@gmail.com"; // Your email address

// Database connection
$conn = new mysqli("localhost", "root", "", "inventory_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products that are expiring within or already expired (4 days or less)
$sql = "SELECT productName, expiryDate FROM inventory";

$result = $conn->query($sql);

// Load previously notified products from a JSON file
$notifiedFile = 'notified_products.json';
$notifiedProducts = [];

if (file_exists($notifiedFile)) {
    $notifiedProducts = json_decode(file_get_contents($notifiedFile), true);
}

// If the JSON file is empty, initialize it as an array
if (!is_array($notifiedProducts)) {
    $notifiedProducts = [];
}

echo "Number of products found: " . $result->num_rows . "<br>"; // For debugging

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productName = $row['productName'];
        $expiryDate = $row['expiryDate'];
        $uniqueProductKey = $productName . '_' . $expiryDate; // Unique key for each product-expiry pair

        // Check if this product-expiry pair has already been notified
        if (isset($notifiedProducts[$uniqueProductKey])) {
            echo "Email already sent for product: $productName with expiry date: $expiryDate.<br>";
            continue; // Skip sending email if already notified
        }

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'handebhagyashri6@gmail.com'; // Your Gmail address
            $mail->Password = 'efsb esqy tnrq sluo'; // Your Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('handebhagyashri6@gmail.com', 'Inventory');
            $mail->addAddress($owner_email);
            $mail->isHTML(true);

            // Calculate number of days left using DateTime
            $today = new DateTime();
         $expiryDT = new DateTime($expiryDate);
$today->setTime(0, 0, 0);
$expiryDT->setTime(0, 0, 0);
$daysLeft = (int)(($expiryDT->getTimestamp() - $today->getTimestamp()) / 86400);

            // Set email subject and body based on days left
            if ($daysLeft > 0 && $daysLeft <= 4) {
                $mail->Subject = "Product Expiry Alert";
                $mail->Body = "<h1>Expiry Alert</h1>
                              <p>The product <strong>$productName</strong> expires in <strong>$daysLeft day(s)</strong>. Expiry Date: <strong>$expiryDate</strong>.</p>";
                $mail->AltBody = "The product '$productName' expires in $daysLeft day(s). Expiry Date: $expiryDate.";
            } elseif ($daysLeft == 0) {
                $mail->Subject = "Product Expiry Alert";
                $mail->Body = "<h1>Expiry Alert</h1>
                              <p>The product <strong>$productName</strong> expires <strong>today</strong>! Expiry Date: <strong>$expiryDate</strong>.</p>";
                $mail->AltBody = "The product '$productName' expires today! Expiry Date: $expiryDate.";
            } else {
                $mail->Subject = "Expired Product Alert";
                $mail->Body = "<h1>Expired Product Alert</h1>
                              <p>The product <strong>$productName</strong> has already expired. Expiry Date was: <strong>$expiryDate</strong>.</p>";
                $mail->AltBody = "The product '$productName' has already expired. Expiry Date was: $expiryDate.";
            }

            if ($mail->send()) {
                echo "Email sent successfully for product: $productName.<br>";

                // Mark this product-expiry pair as notified
                $notifiedProducts[$uniqueProductKey] = true;

                // Save the updated list to the JSON file
                file_put_contents($notifiedFile, json_encode($notifiedProducts));
            } else {
                echo "Failed to send email for product: $productName.<br>";
            }

        } catch (Exception $e) {
            echo "Mailer Error for product $productName: " . $mail->ErrorInfo . "<br>";
        }
    }
} else {
    echo "No products found expiring within or exactly in 4 days.";
}

$conn->close();

?>