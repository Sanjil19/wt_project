<?php
session_start();
include '../database/dbconnect.php';

$error_message = '';

// Handle login when form is submitted
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // Simple MD5 hashing

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($user['password'] === $password) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../index.php");
            exit();
        } else {
            $error_message = "Invalid email or password";
        }
    } else {
        $error_message = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - E-Tech</title>
  <link rel="stylesheet" href="../styles/login.css" />
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
  <div class="auth-container">
    <!-- logo outside the form -->
    <div class="auth-logo">
      <img src="../pics/logo.svg" alt="E-Tech" height="50" />
    </div>
    
    <div class="auth-card">
      <div class="auth-header">
        <h1>Log in</h1>
      </div>
      
      <?php if ($error_message): ?>
        <div class="error-message">
          <?php echo $error_message; ?>
        </div>
      <?php endif; ?>
      
      <form method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="you@example.com" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>
        
        <button type="submit" name="login" class="auth-btn">
          Log In
        </button>
      </form>
      
      <div class="auth-divider">
        <span>or</span>
      </div>
      
      <div class="auth-links">
        <p>Don't have an account? <a href="register.php">Sign up</a></p>
      </div>
    </div>
    
    <div class="auth-footer">
      <a href="../index.php">← Back to E-Tech</a>
    </div>
  </div>
</body>
</html>
