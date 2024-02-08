<?php
session_start();
// Connect to MySQL database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form was submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user with the given username and password
    $sql = "SELECT * FROM etudiant WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if the user exists
    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['cid'] = $row['id'];
      $_SESSION['name'] = $row['first_name'];
      header('location:formation.php');
    } else {
        // User doesn't exist or the password is incorrect
        echo "<script>alert('Invalid Details.');</script>"; 
    }
}

// Close the database connection
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>login étudient</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
      <link href="../css/styles.css" rel="stylesheet" />
   </head>
   <body class="hold-transition login-page" style="background-image: url('bg.jpg');">
   <?php include_once('includes/header.php');?>
      <div class="login-box">
         <!-- /.login-logo -->
         <div class="card card-outline card-primary" style="margin-top: 20%;">
            <div class="card-header text-center">
               <a href="index.html" class="brand-link">
               <img src="../asset/img/logo1.jpeg" alt="DSMS Logo" width="200">
               </a>
            </div>
            <div class="card-body">
               <form  method="post">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="icheck-primary">
                           <input type="checkbox" id="remember">
                           <label for="remember">
                           Remember Me
                           </label>
                        </div>
                     </div>
                     <div class="col-6">
                        <button type="submit" name="submit" class="btn btn-info btn-block">Sign In</button>
                     </div>
                     <div class="col-6">
                        <a href="regester.php" class="text-center btn btn-info btn-block">Register Account</a>
                     </div>
                  </div>
               </form>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->
      <?php include_once('includes/footer.php');?>
   </body>
</html>