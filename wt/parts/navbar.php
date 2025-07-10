<?php if (session_status() === PHP_SESSION_NONE) session_start(); // start session if not started ?>
<header class="navbar">
  <div class="container">
    <div id="logo">
      <a href="../index.php">
        <img src="../pics/logo.svg" alt="Logo" height="60px" />
      </a>
    </div>
    <nav>
      <ul id="nav-list">
        <li><a href="../index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
    <div class="nav-right">
      <div id="search-bar">
        <input type="text" placeholder="Search products..." aria-label="Search" />
        <button><i class="bx bx-search"></i></button>
      </div>
      <div class="action-icons">
        <?php if (!isset($hide_cart) || !$hide_cart): ?>
        <a href="#" class="cart-icon" id="open-cart" title="Cart">
          <i class="bx bx-cart"></i>
          <span class="cart-count">0</span>
        </a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="user-dropdown">
            <a href="#" class="user-icon" title="Profile" id="profile-btn">
              <i class="bx bx-user"></i>
              <span class="username-display"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </a>
            <div class="dropdown-menu" id="user-dropdown">
              <a href="profile.php">Profile</a>
              <a href="orders.php">Orders</a>
              <a href="logout.php">Log out</a>
            </div>
          </div>
        <?php else: ?>
          <div class="user-dropdown">
            <a href="#" class="user-icon" title="Account" id="profile-btn">
              <i class="bx bx-user"></i>
            </a>
            <div class="dropdown-menu" id="user-dropdown">
              <a href="login.php">Log in</a>
              <a href="register.php">Sign up</a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>
<?php if (!isset($hide_cart) || !$hide_cart): ?>
<!-- Cart Sidebar -->
<aside id="cart-sidebar" class="cart-sidebar">
  <div class="cart-header">
    <h2>Your Cart</h2>
    <button id="close-cart" title="Close Cart">&times;</button>
  </div>
  <div id="cart-items" class="cart-items"></div>
  <div class="cart-footer">
    <div class="cart-total">Total: $<span id="cart-total">0.00</span></div>
    <div class="cart-actions">
      <button id="clear-cart" class="btn btn-clear">Clear Cart</button>
      <button id="checkout" class="btn btn-primary">Checkout</button>
    </div>
  </div>
</aside>
<?php endif; ?>
