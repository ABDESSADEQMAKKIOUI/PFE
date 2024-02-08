<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");

// Check connection
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$nom_formation = $_POST['nom_formation'];
    $nivaux_etude = $_POST['nivaux_etude'];
    $nom_complet = $_POST['nom_complet'];
    $cec = $_POST['cec'];
    $cin = $_POST['cin'];
    
    // Insert values into database
    $sql = "INSERT INTO inscrit_formation (nom_formation, nivaux_etude, nom_complet, cec, cin)
            VALUES ('$nom_formation', '$nivaux_etude', '$nom_complet', '$cec', '$cin')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie.";
    } else {
        echo "Erreur lors de l'inscription: " . $conn->error;
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>inscit a une formation</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">

   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
           include_once('includes/sidebar.php');?>
      <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6 animated bounceInRight">
                        <h1 class="m-0"><span class="fa fa-book"></span> Formation</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">formation</li>
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
                <h3 class="card-title">Formulaire d'inscription</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-12">
                     <div class="card-header">
                        <span class="fa fa-book">Formulaire d'inscription</span>
              </div>
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Nom de formation</label>
                    <input type="text" class="form-control">
                  </div>
               </div>
                  <div class="col-md-6">
                  <div class="form-group">
                        <label>nivaux d'étude</label>
                        <select class="form-control">
                          <option>BAC</option>
                          <option>BAC+1</option>
                          <option>BAC+2</option>
                          <option>BAC+3</option>
                          <option>BAC+4 </option>
                          <option>BAC+5</option>
                          
                        </select>
                      </div>
               </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>votre nom complet</label>
                    <input type="text" class="form-control" placeholder="le nom étudient">
                  </div>
               </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>CIN</label>
                    <input type="text" class="form-control" placeholder="donner le cin">
                  </div>
               </div>
            </div>
              </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Valider l'inscription</button>
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
<?php } ?> 