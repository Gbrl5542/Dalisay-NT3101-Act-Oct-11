<?php
include 'includes/validation.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean($_POST['username'] ?? '');
    $email    = clean($_POST['email'] ?? '');
    $phone    = clean($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirmPassword'] ?? '';

    $checks = [
        'username'        => validate_username($username),
        'email'           => validate_email($email),
        'phone'           => validate_phone($phone),
        'password'        => validate_password($password, $username),
        'confirmPassword' => validate_confirm($confirm, $password),
    ];
    foreach ($checks as $key => $msg) {
        if ($msg !== null) $errors[$key] = $msg;
    }

    if (!$errors) {
        header('Location: login.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="css/register.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jurassic-park" rel="stylesheet">
  </head>
  <body>

    <div class="login-card">
        <img src="Images/JPLOGO.png" alt="Logo" class="logo">
      <form id="registerForm" method="post" action="register.php" novalidate>
        <div class="mb-3 input-wrapper">
          <input type="text" id="username" name="username" class="<?php echo field_class($errors, 'username'); ?>" placeholder="Username" value="<?php echo old('username'); ?>" required>
          <i class="bi bi-person icon"></i>
          <div class="fb-error<?php echo isset($errors['username']) ? ' show' : ''; ?>" id="usernameError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?php echo htmlspecialchars($errors['username'] ?? ''); ?></span>
          </div>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="email" id="email" name="email" class="<?php echo field_class($errors, 'email'); ?>" placeholder="Email Address" value="<?php echo old('email'); ?>" required>
          <i class="bi bi-envelope icon"></i>
          <div class="fb-error<?php echo isset($errors['email']) ? ' show' : ''; ?>" id="emailError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?php echo htmlspecialchars($errors['email'] ?? ''); ?></span>
          </div>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="tel" id="phone" name="phone" class="<?php echo field_class($errors, 'phone'); ?>" placeholder="Phone Number" value="<?php echo old('phone'); ?>" required>
          <i class="bi bi-telephone icon"></i>
          <div class="fb-error<?php echo isset($errors['phone']) ? ' show' : ''; ?>" id="phoneError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?php echo htmlspecialchars($errors['phone'] ?? ''); ?></span>
          </div>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="password" id="password" name="password" class="<?php echo field_class($errors, 'password'); ?>" placeholder="Password" required>
          <i class="bi bi-lock icon"></i>
          <div class="fb-error<?php echo isset($errors['password']) ? ' show' : ''; ?>" id="passwordError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?php echo htmlspecialchars($errors['password'] ?? ''); ?></span>
          </div>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="password" id="confirmPassword" name="confirmPassword" class="<?php echo field_class($errors, 'confirmPassword'); ?>" placeholder="Confirm Password" required>
          <i class="bi bi-shield-lock icon"></i>
          <div class="fb-error<?php echo isset($errors['confirmPassword']) ? ' show' : ''; ?>" id="confirmPasswordError">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span><?php echo htmlspecialchars($errors['confirmPassword'] ?? ''); ?></span>
          </div>
        </div>

        <button type="submit" class="btn btn-login w-100">Register</button>

        <div class="text-center mt-3 register-text">
          <span>Already have an account? </span>
          <a href="login.php" class="register-link">Login Here</a>
        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
