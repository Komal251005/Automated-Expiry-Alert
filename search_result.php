<?php
$conn = new mysqli("localhost", "root", "", "inventory_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Search Results</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    .product-card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.2s ease-in-out;
    }
    .product-card:hover {
      transform: scale(1.02);
    }
    .product-img {
      max-height: 180px;
      object-fit: contain;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <!-- 🔙 Back Button -->
    <a href="Inventory.php" class="btn btn-outline-primary mb-4">
      <i class="fa-solid fa-arrow-left me-2"></i> Back to Inventory
    </a>


    <?php
    if (!empty($query)) {
        $sql = "SELECT * FROM inventory WHERE productName LIKE '%$query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">';
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col">
                  <div class="card product-card p-3 h-100">
                    <img src="' . $row['imagePath'] . '" class="card-img-top product-img mx-auto" alt="Product Image">
                    <div class="card-body">
                      <h5 class="card-title">' . $row['productName'] . '</h5>
                      <p class="card-text">
                        <strong>Price:</strong> ₹' . $row['price'] . '<br>
                        <strong>Quantity:</strong> ' . $row['quantity'] . '<br>
                        <strong>Manufactured:</strong> ' . $row['manufacturedDate'] . '<br>
                        <strong>Expiry:</strong> ' . $row['expiryDate'] . '
                      </p>
                    </div>
                  </div>
                </div>';
            }
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning mt-4">No products found.</div>';
        }
    } else {
        echo '<div class="alert alert-danger mt-4">No search query provided.</div>';
    }

    $conn->close();
    ?>
  </div>

  <!-- Font Awesome for icons -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
