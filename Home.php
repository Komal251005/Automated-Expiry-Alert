<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automated Expiry Alerts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

</head>
<body>

          <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        
        <!-- ✅ Logo -->
        <a href="Home.php">
            <img src="medicare.avif" class="nav-img" alt="Logo">
        </a>

         <!-- ✅ Navbar Links with Icons -->
         <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Home.php">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Inventory.php">
                        <i class="fa-solid fa-box"></i> Inventory
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Billing.php">
                        <i class="fa-solid fa-receipt"></i> Billing
                    </a>
                </li>
            </ul>
        </div>
        <a class="logout" href="#" id="logoutBtn">Log Out</a>
</nav>   
  
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Image1.jpeg" height="772px" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="home2.jpg" height="772px" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="Image2.jpg" height="772px" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    

  <script>
    document.getElementById("logoutBtn").addEventListener("click", function (event) {
        event.preventDefault(); 
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "login.php"; 
        }
    });
</script>
 <footer>
  <div class="foot-panel1">
     <a href="Home.php"> Back to top </a>
  </div>
</footer>
<?php 
include 'footer.php';
 ?> 
</body>
</html>
