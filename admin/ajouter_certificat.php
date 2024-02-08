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
    $date_p = $_POST['date_p'];
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
        $stmt = $conn->prepare("INSERT INTO certificat (date_c, formation_id, etudiant_id, secretaire_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $date_p, $formation_id, $etudiant_id, $secretaire_id);

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
      <title>certifications</title>
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
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Ajouter certificat </h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ajouter certificat</li>
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
             <h3 class="card-title">Certificat d'étudiant</h3>
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <form method="POST">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
           Etudiant certificat
        </div>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
          <label for="studentName">Nom d'étudient</label>
          <select class="form-control" id="student" name="student">
            <?php

              // Query the database for student names
              $sq = "SELECT first_name FROM etudiant";
              $resul = mysqli_query($conn, $sq);

              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resul) > 0) {
                while($row = mysqli_fetch_assoc($resul)) {
                  echo "<option>" . $row["first_name"] . "</option>";
                }
              }

              // Close the database connection
             
            ?>
          </select>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="formation">Nom de formation </label>
          <select class="form-control" id="formation_p" name="formation_p">
            <?php

              // Query the database for student names
              $s = "SELECT nom FROM formations";
              $resu = mysqli_query($conn, $s);

              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resu) > 0) {
                while($row = mysqli_fetch_assoc($resu)) {
                  echo "<option>" . $row["nom"] . "</option>";
                }
              }

              // Close the database connection
             
            ?>
          </select>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" class="form-control" id="date_p" name="date_p">
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
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info">
           <div class="card-header" style="background-color: crimson;text-align: center;">
             <h3 class="card-title">Certificats pour groupe</h3>
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <form method="POST">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
           Groupe certificat
        </div>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
          <label for="studentName">Nom du groupe</label>
          <select class="form-control" id="student" name="student">
            <?php

              // Query the database for student names
              $sq = "SELECT * FROM class";
              $resul = mysqli_query($conn, $sq);

              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resul) > 0) {
                while($row = mysqli_fetch_assoc($resul)) {
                  echo "<option>" . $row["nom"] . "</option>";
                }
              }

              // Close the database connection
             
            ?>
          </select>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="formation">Nom de formation </label>
          <select class="form-control" id="formation_p" name="formation_p">
            <?php

              // Query the database for student names
              $s = "SELECT nom FROM formations";
              $resu = mysqli_query($conn, $s);

              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resu) > 0) {
                while($row = mysqli_fetch_assoc($resu)) {
                  echo "<option>" . $row["nom"] . "</option>";
                }
              }

              // Close the database connection
              mysqli_close($conn);
            ?>
          </select>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" class="form-control" id="date_p" name="date_p">
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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php }?>