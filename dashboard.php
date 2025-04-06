<?php include('includes/header.php'); session_start(); ?>
<div class="container mt-5">
  <h2>Welcome to your Dashboard</h2>
  <?php if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login.php'>login</a> first.</p>";
  } else {
    echo "<p>You are logged in as <strong>" . $_SESSION['role'] . "</strong>.</p>";
    if ($_SESSION['role'] === 'recruiter') {
      echo "<a href='post_job.php' class='btn btn-success'>Post a Job</a>";
    } else {
      echo "<a href='view_jobs.php' class='btn btn-info'>View Jobs</a>";
    }
  } ?>
</div>
<?php include('includes/footer.php'); ?>
