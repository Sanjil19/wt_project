<?php
session_start();
include '../database/dbconnect.php';
$show_navbar = true;
$error_message = '';
$success_message = '';

// Handle registration when form is submitted
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // Simple MD5 hashing
    $confirm_password = md5($_POST['confirm_password']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else if ($password != $confirm_password) {
        $error_message = "Passwords do not match";
    } else {
        // Check if user already exists
        $check_sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
        $check_result = mysqli_query($conn, $check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error_message = "Email or username already exists";
        } else {
            $sql = "INSERT INTO users (username, email, password, first_name, last_name) VALUES ('$username', '$email', '$password', '$first_name', '$last_name')";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                $success_message = "Registration successful! You can now log in.";
            } else {
                $error_message = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up - E-Tech</title>
  <link rel="stylesheet" href="../styles/register.css" />
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
        <h1>Create your account</h1>
      </div>
      
      <?php if ($error_message): ?>
        <div class="error-message">
          <?php echo $error_message; ?>
        </div>
      <?php endif; ?>
      
      <?php if ($success_message): ?>
        <div class="success-message">
          <?php echo $success_message; ?>
          <p><a href="login.php">Click here to log in</a></p>
        </div>
      <?php endif; ?>
      
      <form method="POST">
        <div class="form-row">
          <div class="form-group half">
            <label for="first_name">First name</label>
            <input type="text" id="first_name" name="first_name" placeholder="John" required value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>" />
          </div>
          <div class="form-group half">
            <label for="last_name">Last name</label>
            <input type="text" id="last_name" name="last_name" placeholder="Doe" required value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>" />
          </div>
        </div>
        
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="johndoe" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" />
        </div>
        
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="you@example.com" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required />
        </div>
        
        <div class="form-group">
          <label for="confirm_password">Confirm password</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required />
        </div>
        
        <button type="submit" name="register" class="auth-btn">
          Create Account
        </button>
      </form>
      
      <div class="auth-divider">
        <span>or</span>
      </div>
      
      <div class="auth-links">
        <p>Already have an account? <a href="login.php">Log in</a></p>
      </div>
    </div>
    
    <div class="auth-footer">
      <a href="../index.php">← Back to E-Tech</a>
    </div>
  </div>
</body>
</html>
