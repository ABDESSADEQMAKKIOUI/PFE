<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");
if(strlen($_SESSION['name'])==0)
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
  $first_name = $_POST['nom'];
  $last_name = $_POST['prenom'];
  $email = $_POST['email'];
  $tele = $_POST['tele'];
  $username = $_POST['username'];
  $password = $_POST['password'];


  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO Formateur (nom, prenom,email , username, password, tele) VALUES (?, ?, ?, ?,?,?)");
  $stmt->bind_param("ssssss", $first_name,  $last_name, $email , $username,$password,$tele);

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
      <title>formateur</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
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
                  <h1 class="m-0"><span class="fa fa-book"></span>  Ajouter Formateur</h1>
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Ajouter formateur</li>
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
          <h3 class="card-title">Formateur Informations</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="">
          <div class="card-body">
            <div class="row">
            <div class="col-md-12">
               <div class="card-header">
                  <span class="fa fa-book"> Formateur Informations</span>
        </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                  <label for="nom">Nom:</label>
                  <input type="text" class="form-control" id="nom" name="nom" required>
               </div></div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="prenom">Prénom:</label>
                  <input type="text" class="form-control" id="prenom" name="prenom" required>
               </div></div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" required>
               </div></div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="tele">Téléphone:</label>
                  <input type="tele" class="form-control" id="tele" name="tele" required>
               </div></div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" id="username" name="username" required>
               </div></div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password" required>
               </div></div>
      </div>
        </div>
            </div>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
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