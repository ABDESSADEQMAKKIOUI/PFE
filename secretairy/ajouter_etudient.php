<?php
// Create connection
session_start();
$conn = mysqli_connect("localhost", "root", "", "test");
if(strlen($_SESSION['cid'])==0)
  { 
header('location:authentic.php');
}
else{
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
  $stmt = $conn->prepare("INSERT INTO etudiant (first_name,  last_name, gender, birthday, contact, email, address, username, PASSWORD) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssss", $first_name, $last_name, $gender, $birthday, $contact, $email, $address, $username, $password);

  // Execute SQL statement
  if ($stmt->execute()) {
    echo "Data successfully inserted into database.";
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
      <title>Ajouter-etudient</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         <?php
           include_once('includes/sidebar.php');?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     
                     <div class="col-sm-6 animated bounceInRight">
                        <h1 class="m-0"><span class="fa fa-plus"></span>Ajouter étudiant</h1>
                     </div>
                     
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Ajouter étudient</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
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
                                    <label for="exampleInputFile">Choisir un Profile</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="exampleInputFile">
                                          <label class="custom-file-label" for="exampleInputFile">Choisir file</label>
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
                                          <label for="exampleInputEmail1">Prénom</label>
                                          <input type="text" class="form-control" placeholder="first name" name="first_name" id="first_name">
                                       </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Nom</label>
                                          <input type="text" class="form-control" placeholder="last name" name="last_name" id="last_name">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label>Genre</label>
                                          <select class="form-control" name="gender" id="gender">
                                             <option>Male</option>
                                             <option>Female</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="exampleInputEmail1">Date de naissance</label>
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
                                          <label for="exampleInputEmail1">Adresse</label>
                                          <input type="text" class="form-control" placeholder="address" name="address" id="address">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="card-header">
                                          <span class="fa fa-key">compte</span>
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
                        <button class="text-center btn btn-info btn-block" type="submit">Ajouter</button> 
                     </div>
                   </div><br>
                     </form>
            </div>
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php }?>