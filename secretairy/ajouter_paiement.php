<?php
// Create connection
session_start();
$conn = mysqli_connect("localhost", "root", "", "test");
if (strlen($_SESSION['name']) == 0) {
  header('location:authentic.php');
} else {
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Process form data and insert into database
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $first_name = $_POST['student'];
    $prix = $_POST['prix'];
    $date_p = $_POST['date_p'];
    $remark = $_POST['remark'];
    $formation_p = $_POST['formation_p'];
    $secretaire_id = $_SESSION['cid']; // Assuming you have the secretary ID stored in the session

    // Retrieve etudiant_id from etudiant table
    $stmt = $conn->prepare("SELECT id FROM etudiant WHERE first_name = ?");
    $stmt->bind_param("s", $first_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $etudiant_id = $row['id'];

      // Retrieve formation_id from formation table
      $stmt = $conn->prepare("SELECT id FROM formations WHERE nom = ?");
      $stmt->bind_param("s", $formation_p);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $formation_id = $row['id'];

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO paiement (prix, date_p, remark, formation_id, etudiant_id, secretaire_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiii", $prix, $date_p, $remark, $formation_id, $etudiant_id, $secretaire_id);

        // Execute SQL statement
        if ($stmt->execute()) {
          echo "Data successfully inserted into database.";
        } else {
          echo "Error inserting data into database: " . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
      } else {
        echo "Formation not found in the database.";
      }
    } else {
      echo "Student not found in the database.";
    }

    // Close connection

  }

?>



<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ajouter paiement</title>
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
                     <h1 class="m-0" style="color: rgb(241, 9, 9);"><span class="fa fa-money-bill"></span>Ajouter paiement</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ajouter paiement</li>
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
             <h3 class="card-title">Paiement Information</h3>
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <form method="POST">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <span class="fa fa-money-bill"> Paiement Information</span>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Etudiant</label>
              <select class="form-control" name="student">
                <?php
                // Retrieve students from database
                $sql = "SELECT * FROM etudiant ";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['first_name'] . "'>" . $row['first_name'] . "</option>";
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Prix payé</label>
              <input type="text" name="prix" class="form-control" placeholder="amount">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Date de paiement</label>
              <input type="date" name="date_p" class="form-control" placeholder="reference">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Formation</label>
              <select class="form-control" name="formation_p">
                <?php
                // Retrieve formations from database
                $sql = "SELECT * FROM formations";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['nom'] . "'>" . $row['nom'] . "</option>";
                  }
                }
                ?>
              </select>
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