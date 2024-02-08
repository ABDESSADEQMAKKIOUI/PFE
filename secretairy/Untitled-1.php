<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the form values
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $formation = $_POST["formation"];
    $email = $_POST["email"];
    
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE formateur SET nom=?, prenom=?,  email=? WHERE id=?");
    
    // Get the formateur ID from the URL
    $id = $_GET['id'];
    
    $stmt->bind_param("ssssi", $nom, $prenom, $email, $id);
    
    // Execute the update statement
    if ($stmt->execute() === TRUE) {
        echo "Formateur updated successfully";
    } else {
        echo "Error updating formateur: " . $conn->error;
    }
    
    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>groups-Manag</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
<style>
   /* Style pour le tableau des certifications */
table {
  width: 80%;
  float: right;
  margin-top: 30px;
}

th, td {
  text-align: center;
  vertical-align: middle;
}

th {
  font-weight: bold;
}

thead th {
  background-color: #343a40;
  color: #fff;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

tbody tr:hover {
  background-color: #e2e2e2;
}

.btn {
  margin-right: 5px;
}
</style>
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
                     <h1 class="m-0"><span class="fa fa-users"></span> Edit Formateur</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Formateurs</a></li>
                        <li class="breadcrumb-item active">Edit Formateur</li>
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
    <div class="card-body animated pulse">
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check if formateur ID is set and not empty
        if (isset($_GET['id']) && !empty($_GET['id'])) {
          // Connect to database
          
          // Retrieve formateur information from database
          $id = $_GET['id'];
          $query = "SELECT * FROM formateur WHERE id = $id";
          $resul = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($resul);
          
          // Close database connection
          mysqli_close($conn);
      ?>
      <form method="post" action="gérer_formateur.php">
        <div class="form-group">
          <label for="nom">Nom:</label>
          <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $row['nom']; ?>" required>
        </div>
        <div class="form-group">
          <label for="prenom">Prénom:</label>
          <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo $row['prenom']; ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php echo $row['email']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
      <?php
        } else {
          echo "Formateur ID not specified.";
        }
      ?>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
   </div>
      </div>

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