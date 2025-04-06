<?php include('includes/header.php'); include('includes/db.php'); ?>

<div class="container mt-5">
  <h2>User Registration</h2>
  <form method="POST" action="register.php">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select name="role" class="form-select">
        <option value="jobseeker">Job Seeker</option>
        <option value="recruiter">Recruiter</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // ✅ Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<div class='alert alert-warning mt-3'>Email is already registered. <a href='login.php'>Login here</a></div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $username, $email, $password, $role);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-3'>Registration successful. <a href='login.php'>Login here</a></div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error during execution: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger mt-3'>Error preparing statement: " . $conn->error . "</div>";
        }
    }

    $check->close();
}
?>

<?php include('includes/footer.php'); ?>
