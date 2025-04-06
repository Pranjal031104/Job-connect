<?php include('includes/header.php'); include('includes/db.php'); session_start(); ?>
<div class="container mt-5">
  <h2>Available Jobs</h2>
  <?php
  $result = $conn->query("SELECT * FROM jobs");
  while ($row = $result->fetch_assoc()) {
    echo "<div class='card mb-3'>
      <div class='card-body'>
        <h5 class='card-title'>" . $row['title'] . "</h5>
        <p class='card-text'>" . $row['description'] . "</p>
        <p class='card-text'><strong>Location:</strong> " . $row['location'] . "</p>
        <a href='apply.php?job_id=" . $row['id'] . "' class='btn btn-primary'>Apply</a>
      </div>
    </div>";
  }
  ?>
</div>
<?php include('includes/footer.php'); ?>
