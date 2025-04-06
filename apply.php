<?php include('includes/header.php'); include('includes/db.php'); session_start(); ?>
<div class="container mt-5">
  <h2>Apply to Job</h2>
<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'jobseeker') {
    echo "<div class='alert alert-warning'>Only job seekers can apply. <a href='login.php'>Login here</a></div>";
} else {
    $job_id = $_GET['job_id'];
    $user_id = $_SESSION['user_id'];

    $check = $conn->prepare("SELECT * FROM applications WHERE user_id = ? AND job_id = ?");
    $check->bind_param("ii", $user_id, $job_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<div class='alert alert-info'>You have already applied to this job.</div>";
    } else {
        $apply = $conn->prepare("INSERT INTO applications (user_id, job_id) VALUES (?, ?)");
        $apply->bind_param("ii", $user_id, $job_id);
        if ($apply->execute()) {
            echo "<div class='alert alert-success'>Application submitted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Something went wrong. Try again.</div>";
        }
    }
}
?>
</div>
<?php include('includes/footer.php'); ?>