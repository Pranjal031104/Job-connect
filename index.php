<?php include('includes/header.php'); ?>

<div class="container mt-5">
  <div class="jumbotron text-center">
    <h1 class="display-4">Welcome to JobConnect</h1>
    <p class="lead">Your gateway to internships and job opportunities</p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="register.php" role="button">Get Started</a>
  </div>
</div>

<?php include('includes/footer.php'); ?>


<!-- includes/db.php -->
<?php
$host = 'localhost';
$user = 'root';
$password = '0703';
$database = 'jobconnect';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>