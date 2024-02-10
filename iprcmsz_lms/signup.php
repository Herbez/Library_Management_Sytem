
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
  <title>IPRC MUSANZE LMS</title>


</head>
<body>

<div class="signup-container">
    <header>
        <img src="RP_Logo.jpeg" alt="IPRC MUSANZE LMS Logo" id="logo" class="logo">
        <h2 class="text-center">IPRC MUSANZE LMS</h2>
      </header>
  <form name="signupForm" action="" method="POST" >
    <div class="form-row">
      <div class="form-group col-md-6">
        <label >Names:</label>
        <input type="text" class="form-control" name="Name"  placeholder="Enter Full Names" required>
        <small class="text-danger" id="errorName"></small>
      </div>
    
      <div class="form-group col-md-6">
        <label >Email:</label>
        <input type="email" class="form-control" name="Email" placeholder="Enter your email" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label >Phone:</label>
        <input type="number" class="form-control" name="Phone" placeholder="Enter Phone" required>
      </div>
    
      <div class="form-group col-md-6">
        <label >Category:</label>
        <select class="form-control" name="Category" >
          <option value="" selected disabled>Select category</option>
          <option value="student">Student</option>
          <option value="teacher">Teacher</option>
        </select>
      </div>

    </div>

    <div class="form-row">
    
      <div class="form-group col-md-6">
        <label >Department:</label>
        <select class="form-control" name="Department" >
          <option value="" selected disabled>Select Department</option>
          <option value="ICT">ICT</option>
          <option value="Food Processing">Food Processing</option>
          <option value="Electrical">Electrical</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label >Password:</label>
        <input type="password" class="form-control" name="Password" placeholder="Enter Password" required>
      </div>
    </div> 

    <button type="submit" name="signup" class="btn btn-primary">Sign Up <i class="fas fa-sign-in-alt"></i> </button>
  </form>

  <div class="sign-up mt-3">
    Already have an account? <a href="index.php">Login </a>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<?php
require('dbconn.php');

if (isset($_POST['signup'])) {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $category = $_POST['Category'];
    $department = $_POST['Department'];
    $password = $_POST['Password'];

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM user WHERE email = '$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "<script type='text/javascript'>alert('Email already exists. Please choose a different email.')</script>";
    } else {
        // Email does not exist, proceed with registration
        $insertQuery = "INSERT INTO user (names, email, phone, category, department, password) 
                        VALUES ('$name', '$email', '$phone', '$category', '$department', '$password')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script type='text/javascript'>alert('Registration Successful')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Registration failed. Please try again.')</script>";
        }
    }
}
?>


</body>
</html>
