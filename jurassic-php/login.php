<?php
include 'includes/validation.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        $errors['username'] = 'Please enter your username or email.';
    } elseif (!preg_match(RX_USERNAME, $username) && !preg_match(RX_EMAIL, $username)) {
        $errors['username'] = 'Enter a valid username (letters, numbers, _) or email address.';
    }

    if ($password === '') {
        $errors['password'] = 'Please enter your password.';
    } elseif (!preg_match(RX_LOGIN_PASSWORD, $password)) {
        $errors['password'] = 'Password must be at least 6 characters with no spaces.';
    }

    if (!$errors) {
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jurassic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="css/login.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jurassic-park" rel="stylesheet">
  </head>
  <body>

    <div class="login-card">
      <img src="Images/JPLOGO.png" alt="Logo" class="logo">
      <form id="loginForm" method="post" action="login.php" novalidate>
        <div class="mb-3">
          <input type="text" id="loginUsername" name="username" class="<?php echo field_class($errors, 'username'); ?>" placeholder="Username" value="<?php echo old('username'); ?>" required>
          <div class="fb-error<?php echo isset($errors['username']) ? ' show' : ''; ?>" id="loginUsernameError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?php echo htmlspecialchars($errors['username'] ?? ''); ?></span>
          </div>
        </div>

        <div class="mb-3">
          <input type="password" id="loginPassword" name="password" class="<?php echo field_class($errors, 'password'); ?>" placeholder="Password" required>
          <div class="fb-error<?php echo isset($errors['password']) ? ' show' : ''; ?>" id="loginPasswordError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?php echo htmlspecialchars($errors['password'] ?? ''); ?></span>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 options-row">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-login w-100">Login</button>

        <div class="text-center mt-3 register-text">
          <span>Don't have an account? </span>
          <a href="register.php" class="register-link">Register</a>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
