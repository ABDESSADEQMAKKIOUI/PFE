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
  $NOM = $_POST['nom'];
  $TYPE = $_POST['type'];
  $prix = $_POST['prix'];
  $date = $_POST['date_p'];
  $remarque = $_POST['remark'];


  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO ressource (nom, type_r , prix ,date_ajoute,remarque) VALUES (?, ?,?,?,?)");
  if (!$stmt) {
   die("Error preparing SQL statement: " . $conn->error);
 }
 
  $stmt->bind_param("sssss", $NOM, $TYPE,$prix,$date,$remarque);

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
      <title>ressource</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
         
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <?php
         include_once('includes/sidebar.php');?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Ajouter ressource</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ajouter ressource</li>
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
             <h3 class="card-title">Ressource Information</h3>
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <form method="POST">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <span class="fa fa-money-bill"> Ressource Information</span>
        </div>
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <label>Prix payé</label>
              <input type="text" name="prix" class="form-control" placeholder="amount" require>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Date d'ajoute</label>
              <input type="date" name="date_p" class="form-control" require>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Nom</label>
              <input type="text" name="nom" class="form-control" require>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Type</label>
              <input type="text" name="type" class="form-control" require>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              <label>Remarque</label>
              <input type="text" name="remark" class="form-control" placeholder="remarks">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="card-footer">
  <button type="submit" class="btn btn-primary" name="save">Save</button>
</div>
</form>
  
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