<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Products - E-Tech</title>
  <link rel="stylesheet" href="../styles/styles.css" />
  <link rel="stylesheet" href="../styles/navbar-footer.css" />
  <link rel="stylesheet" href="../styles/products.css" />
  <link rel="stylesheet" href="../styles/cart.css" />
  <link rel="stylesheet" href="../styles/cart.css" />
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
</head>
<body>
  <?php include '../parts/navbar.php'; ?>
  <main class="container">
    <h2 class="section-title">All Products</h2>
    <section class="products">
      <div class="product-card">
        <a href="#"><img src="../pics/aceraspire.jpg" alt="Acer Aspire 5" /></a>
        <div class="product-info">
          <h3>Acer Aspire 5</h3>
          <div class="price">$999.99</div>
          <button class="add-to-cart" data-product='{"id":"acer-aspire-5","name":"Acer Aspire 5","price":999.99,"image":"../pics/aceraspire.jpg"}'>Add to Cart</button>
        </div>
      </div>
      <div class="product-card">
        <a href="#"><img src="../pics/macbook.jpg" alt="MacBook Pro 14" /></a>
        <div class="product-info">
          <h3>MacBook Pro 14"</h3>
          <div class="price">$1,999.99</div>
          <button class="add-to-cart" data-product='{"id":"macbook-pro-14","name":"MacBook Pro 14","price":1999.99,"image":"../pics/macbook.jpg"}'>Add to Cart</button>
        </div>
      </div>
      <div class="product-card">
        <a href="#"><img src="../pics/oldmac.jpg" alt="MacBook Air M1" /></a>
        <div class="product-info">
          <h3>MacBook Air M1</h3>
          <div class="price">$899.99</div>
          <button class="add-to-cart" data-product='{"id":"macbook-air-m1","name":"MacBook Air M1","price":899.99,"image":"../pics/oldmac.jpg"}'>Add to Cart</button>
        </div>
      </div>
      <div class="product-card">
        <a href="#"><img src="../pics/hpPavillion.jpg" alt="HP Pavilion" /></a>
        <div class="product-info">
          <h3>HP Pavilion</h3>
          <div class="price">$799.99</div>
          <button class="add-to-cart" data-product='{"id":"hp-pavilion","name":"HP Pavilion","price":799.99,"image":"../pics/hpPavillion.jpg"}'>Add to Cart</button>
        </div>
      </div>
      <div class="product-card">
        <a href="#"><img src="../pics/dellXps.jpg" alt="Dell XPS 13" /></a>
        <div class="product-info">
          <h3>Dell XPS 13</h3>
          <div class="price">$1,299.99</div>
          <button class="add-to-cart" data-product='{"id":"dell-xps-13","name":"Dell XPS 13","price":1299.99,"image":"../pics/dellXps.jpg"}'>Add to Cart</button>
        </div>
      </div>
      <div class="product-card">
        <a href="#"><img src="../pics/thinkpad.jpg" alt="Lenovo ThinkPad" /></a>
        <div class="product-info">
          <h3>Lenovo ThinkPad</h3>
          <div class="price">$1,099.99</div>
          <button class="add-to-cart" data-product='{"id":"lenovo-thinkpad","name":"Lenovo ThinkPad","price":1099.99,"image":"../pics/thinkpad.jpg"}'>Add to Cart</button>
        </div>
      </div>
      <div class="product-card">
        <a href="#"><img src="../pics/macbook2.jpg" alt="MacBook Pro 16" /></a>
        <div class="product-info">
          <h3>MacBook Pro 16"</h3>
          <div class="price">$2,399.99</div>
          <button class="add-to-cart" data-product='{"id":"macbook-pro-16","name":"MacBook Pro 16","price":2399.99,"image":"../pics/macbook2.jpg"}'>Add to Cart</button>
        </div>
      </div>
    </section>
  </main>
  <?php include '../parts/footer.php'; ?>
  <script src="../scripts/script.js"></script>
</body>
</html>
