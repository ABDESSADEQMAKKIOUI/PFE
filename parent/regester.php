<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process form data and insert into database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve form data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $gender = $_POST['gender'];
  $birthday = $_POST['birthday'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO users (first_name,  last_name, gender, birthday, contact, email, address, username, PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssssss", $first_name,  $last_name, $gender, $birthday, $contact, $email, $address, $username, $password);

  // Execute SQL statement
  if ($stmt->execute()) {
   header('location:gérer_formation.php');
  } else {
    echo "Error inserting data into database: " . $conn->error;
  }

  // Close statement and connection
  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Driving-School-Management-System</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
      <link rel="stylesheet" href="../asset/css/style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
      <link href="../css/styles.css" rel="stylesheet" />

   </head>
   <body class="hold-transition login-page" style="background-image: url('bg.jpg');">
   <?php include_once('includes/header.php');?>
      <div class="login-box" style="width: 50%">
         <!-- /.login-logo -->
         <div class="card card-outline" style="margin-top: 10%;">
            <section class="content">
               <div class="container-fluid">
                  <div class="card card-info">
                     <div class="card-header">
                        <h3 class="card-title">Profile Information</h3>
                     </div>
                     <!-- /.card-header -->
                     <!-- form start -->
                     <form method="POST" action="">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <img src="asset/img/avatar.jpg" width="150" style="border-radius: 5px">
                                    <label for="exampleInputFile">Choose Profile</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="exampleInputFile">
                                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="card-header">
                                    <span class="fa fa-user"> Profile Information</span>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">First Name</label>
                                          <input type="text" class="form-control" placeholder="first name" name="first_name" id="first_name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Last Name</label>
                                          <input type="text" class="form-control" placeholder="last name" name="last_name" id="last_name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Gender</label>
                                          <select class="form-control" name="gender" id="gender">
                                             <option>Male</option>
                                             <option>Female</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Birthday</label>
                                          <input type="date" class="form-control" placeholder="last name" name="birthday" id="birthday">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group"> 
                                          <label for="exampleInputEmail1">Contact</label>
                                          <input type="tel" class="form-control" placeholder="contact"  name="contact" id="contact">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Email</label>
                                          <input type="email" class="form-control" placeholder="email" name="email" id="email">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Address</label>
                                          <input type="text" class="form-control" placeholder="address" name="address" id="address">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="card-header">
                                          <span class="fa fa-key"> Account</span>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Username</label>
                                          <input type="text" class="form-control" placeholder="username" name="username" id="username">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Password</label>
                                          <input type="password" class="form-control" placeholder="**********" name="password" id="password">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="row">
                        <div class="col-6">
                        <button type="submit" class="btn btn-info btn-block">Register</button>
                     </div>
                     <div class="col-6">
                        <a href="authentic.php" class="text-center btn btn-info btn-block">Sign In</a>
                     </div>
                   </div><br>
                     </form>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
         </div>
         <!-- /.card -->
      </div>
      <!-- /.login-box -->
      <?php include_once('includes/footer.php');?>
   </body>
</html>