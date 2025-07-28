<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - E-Tech</title>
  <link rel="stylesheet" href="../styles/styles.css" />
  <link rel="stylesheet" href="../styles/navbar-footer.css" />
  <link rel="stylesheet" href="../styles/contact.css" />
  <link rel="stylesheet" href="../styles/cart.css" />
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
</head>
<body>
  <?php include '../parts/navbar.php'; ?>
  <main class="container">
    <h2 class="section-title">Contact Us</h2>
    <form style="max-width:500px;margin:0 auto;" method="post" action="#">
      <div style="margin-bottom:18px;">
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" required style="width:100%;padding:8px;">
      </div>
      <div style="margin-bottom:18px;">
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required style="width:100%;padding:8px;">
      </div>
      <div style="margin-bottom:18px;">
        <label for="message">Message</label><br>
        <textarea id="message" name="message" rows="5" required style="width:100%;padding:8px;"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
  </main>
  <script src="../scripts/script.js"></script>

  
</body>
</html>
