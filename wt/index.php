<?php
// Start session for user tracking
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Tech - Modern E-Commerce</title>
  
  <!-- CSS Stylesheets -->
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="stylesheet" href="styles/navbar-footer.css" />
  <link rel="stylesheet" href="styles/index.css" />
  <link rel="stylesheet" href="styles/cart.css" />
  
  <!-- Icon Library - Boxicons for beautiful icons -->
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  
  <!-- Google Font - Poppins for modern typography -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
</head>

<body>
  <!-- HEADER SECTION: Navigation bar with logo, menu, and user actions -->
  <header class="navbar">
    <div class="container">
      
      <!-- Logo Area -->
      <div id="logo">
        <a href="index.php">
          <img src="pics/logo.svg" alt="E-Tech logo" height="60px" />
        </a>
      </div>

      <!-- Main Navigation Menu -->
      <nav>
        <ul id="nav-list">
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="pages/products.php">Products</a></li>
          <li><a href="pages/about.php">About</a></li>
          <li><a href="pages/contact.php">Contact</a></li>
        </ul>
      </nav>

      <!-- Right Side: Search, Cart, and User Menu -->
      <div class="nav-right">
        
        <!-- Search Bar -->
        <div id="search-bar">
          <input type="text" placeholder="Search products..." aria-label="Search" />
          <button><i class="bx bx-search"></i></button>
        </div>

        <!-- Action Icons: Cart and User -->
        <div class="action-icons">
          
          <!-- Shopping Cart Icon -->
          <a href="#" class="cart-icon" id="open-cart" title="Cart">
            <i class="bx bx-cart"></i>
            <span class="cart-count">0</span>
          </a>
          
          <!-- User Account Dropdown -->
          <div class="user-dropdown">
            <?php if (isset($_SESSION['user_id'])): ?>
              <!-- User is logged in -->
              <a href="#" class="user-icon" title="Profile" id="profile-btn">
                <i class="bx bx-user"></i>
                <span class="username-display"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
              </a>
              <div class="dropdown-menu" id="user-dropdown">
                <a href="pages/profile.php">Profile</a>
                <a href="pages/orders.php">Orders</a>
                <a href="pages/logout.php">Log out</a>
              </div>
            <?php else: ?>
              <!-- User is not logged in -->
              <a href="#" class="user-icon" title="Account" id="profile-btn">
                <i class="bx bx-user"></i>
              </a>
              <div class="dropdown-menu" id="user-dropdown">
                <a href="pages/login.php">Log in</a>
                <a href="pages/register.php">Sign up</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- SHOPPING CART SIDEBAR: Hidden by default, opens when cart icon is clicked -->
  <aside id="cart-sidebar" class="cart-sidebar">
    <div class="cart-header">
      <h2>Your Cart</h2>
      <button id="close-cart" title="Close Cart">&times;</button>
    </div>
    <div id="cart-items" class="cart-items">
      <!-- Cart items will be added here dynamically -->
    </div>
    <div class="cart-footer">
      <div class="cart-total">Total: $<span id="cart-total">0.00</span></div>
      <div class="cart-actions">
        <button id="clear-cart" class="btn btn-clear">Clear Cart</button>
        <button id="checkout" class="btn btn-primary">Checkout</button>
      </div>
    </div>
  </aside>

  <!-- HERO SECTION: Main banner with welcome message -->
  <section class="top-section">
    <div class="container">
      <div class="hero-content">
        <h1>Welcome to E-Tech</h1>
        <p>Discover the latest tech gadgets at amazing prices</p>
        <a href="#" class="btn">Shop Now</a>
      </div>
    </div>
  </section>

  <!-- PRODUCTS SECTION: Display featured products -->
  <main class="container">
    <h2 class="section-title">Featured Products</h2>

    <section class="products">
      
      <!-- Product 1: Acer Aspire 5 -->
      <div class="product-card">
        <div class="product-badge">Sale</div>
        <a href="#">
          <img src="pics/aceraspire.jpg" alt="Acer Laptop" />
        </a>
        <div class="product-info">
          <h3>Acer Aspire 5</h3>
          <div class="price">
            $999.99 
            <span class="old-price">$1,199.99</span>
          </div>
          <div class="rating">
            <!-- Star rating using boxicons -->
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star-half"></i>
            <span>(24 reviews)</span>
          </div>
          <button class="add-to-cart" data-product='{"id":"acer-aspire-5","name":"Acer Aspire 5","price":999.99,"image":"pics/aceraspire.jpg"}'>
            <i class="bx bx-cart-add"></i> Add to Cart
          </button>
        </div>
      </div>

      <!-- Product 2: MacBook Pro -->
      <div class="product-card">
        <div class="product-badge">New</div>
        <a href="#">
          <img src="pics/macbook.jpg" alt="MacBook Pro" />
        </a>
        <div class="product-info">
          <h3>MacBook Pro 14"</h3>
          <div class="price">$1,999.99</div>
          <div class="rating">
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <span>(42 reviews)</span>
          </div>
          <button class="add-to-cart" data-product='{"id":"macbook-pro-14","name":"MacBook Pro 14","price":1999.99,"image":"pics/macbook.jpg"}'>
            <i class="bx bx-cart-add"></i> Add to Cart
          </button>
        </div>
      </div>

      <!-- Product 3: MacBook Air -->
      <div class="product-card">
        <a href="#">
          <img src="pics/oldmac.jpg" alt="MacBook Air" />
        </a>
        <div class="product-info">
          <h3>MacBook Air M1</h3>
          <div class="price">$899.99</div>
          <div class="rating">
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bxs-star"></i>
            <i class="bx bx-star"></i>
            <span>(18 reviews)</span>
          </div>
          <button class="add-to-cart" data-product='{"id":"macbook-air-m1","name":"MacBook Air M1","price":899.99,"image":"pics/oldmac.jpg"}'>
            <i class="bx bx-cart-add"></i> Add to Cart
          </button>
        </div>
      </div>
      
    </section>
  </main>

  <!-- FOOTER SECTION: Company information and links -->
  <footer>
    <div class="container">
      <div class="footer-content">
        
        <!-- Company Information -->
        <div class="footer-section about">
          <div class="logo-footer">
            <img src="pics/logo.svg" alt="Logo" height="50px" />
          </div>
          <p>
            Your one-stop shop for the latest tech gadgets and electronics at competitive prices.
          </p>
          <!-- Social Media Links -->
          <div class="social-links">
            <a href="#"><i class="bx bxl-facebook"></i></a>
            <a href="#"><i class="bx bxl-twitter"></i></a>
            <a href="#"><i class="bx bxl-instagram"></i></a>
          </div>
        </div>

        <!-- Quick Navigation Links -->
        <div class="footer-section links">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>

        <!-- Contact Information -->
        <div class="footer-section contact">
          <h3>Contact Us</h3>
          <p><i class="bx bx-map"></i> Lalitpur, Balkumari</p>
          <p><i class="bx bx-phone"></i> (123) 456-7890</p>
          <p><i class="bx bx-envelope"></i> info@e-tech.com</p>
        </div>
        
      </div>
    </div>

    <!-- Copyright Information -->
    <div class="footer-bottom">
      <div class="container">
        &copy; 2025 E-Tech. All Rights Reserved. | Designed by Sanjil Dahal
      </div>
    </div>
  </footer>

  <!-- JavaScript for interactive features like cart functionality -->
  <script src="scripts/script.js"></script>
</body>

</html>