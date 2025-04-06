<?php include('includes/header.php'); include('includes/db.php'); session_start(); ?>
<div class="container mt-5">
  <h2>Login</h2>
  <form method="POST" action="login.php">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<div class='alert alert-danger mt-3'>Invalid credentials.</div>";
        }
    } else {
        echo "<div class='alert alert-danger mt-3'>User not found.</div>";
    }
}
?>
<?php include('includes/footer.php'); ?>
