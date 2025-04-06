<?php include('includes/header.php'); include('includes/db.php'); session_start(); ?>
<div class="container mt-5">
  <h2>Post a New Job</h2>
  <form method="POST" action="post_job.php">
    <div class="mb-3">
      <label class="form-label">Job Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Location</label>
      <input type="text" name="location" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Post Job</button>
  </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO jobs (title, description, location, posted_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $description, $location, $user_id);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success mt-3'>Job posted successfully!</div>";
    }
}
?>
<?php include('includes/footer.php'); ?>