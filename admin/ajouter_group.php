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
    $teacherName = $_POST['teacherName'];
    $groupName = $_POST['groupName'];
    $formation = $_POST['formation'];

    $s = "SELECT * FROM formations WHERE nom LIKE '%$formation%'";
    $resu = mysqli_query($conn, $s);
    if (!$resu) {
      die("Error in SQL query: " . mysqli_error($conn));
    }
    if (mysqli_num_rows($resu) > 0) {
      while($ro = mysqli_fetch_assoc($resu)) {
        $id_formation = $ro['id'];
      }
    }

    $sq = "SELECT id FROM formateur WHERE nom LIKE '%$teacherName%'";
    $resul = mysqli_query($conn, $sq);
    if (mysqli_num_rows($resul) > 0) {
      while($row = mysqli_fetch_assoc($resul)) {
        $id_formateur = $row['id'];
      }
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO class (nom) VALUES (?)");
    if (!$stmt) {
      die("Error preparing SQL statement: " . $conn->error);
    }
    // Bind parameters
    $stmt->bind_param("s", $groupName);

    // Execute SQL statement
    if ($stmt->execute()) {
      $class_id = $stmt->insert_id; // Get the ID of the inserted class

      // Insert into class_formateur table
      $stmt2 = $conn->prepare("INSERT INTO class_formateur (class_id, formateur_id) VALUES (?, ?)");
      if (!$stmt2) {
        die("Error preparing SQL statement: " . $conn->error);
      }
      $stmt2->bind_param("ii", $class_id, $id_formateur);
      if ($stmt2->execute()) {
        $stmt2->close();
      } else {
        die("Error inserting data into class_formateur table: " . $stmt2->error);
      }

      // Insert into class_formation table
      $stmt3 = $conn->prepare("INSERT INTO class_formations (class_id, formation_id) VALUES (?, ?)");
      if (!$stmt3) {
        die("Error preparing SQL statement: " . $conn->error);
      }
      $stmt3->bind_param("ii", $class_id, $id_formation);
      if ($stmt3->execute()) {
        echo "Data successfully inserted into the database.";
      } else {
        die("Error inserting data into class_formation table: " . $stmt3->error);
      }

      $stmt3->close();
    } else {
      die("Error inserting data into class table: " . $stmt->error);
    }

    // Close statement and connection
    $stmt->close();
  }

?>




<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Etudient</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">

            <style>
               /* Changer la couleur de fond du corps de la page */
body {
	background-color: #f2f2f2;
}

/* Centrez le formulaire et ajustez la largeur */
.fr {
	margin-top: 50px;
	max-width: 700px;
	margin-left: auto;
	margin-right: auto;
   background-color: #f2f2f2;
}

/* Styliser le titre du formulaire */
h1 {
	text-align: center;
	margin-bottom: 30px;
   color: crimson;
   font-weight: bold;
   font-size: 30px;
}

/* Styliser les labels du formulaire */
label {
	font-weight: bold;
   margin-left: 25px;
}

/* Styliser les champs de saisie du formulaire */
.form-control {
	border-radius: 0;
}

/* Styliser le bouton d'enregistrement */
.btn-primary {
	border-radius: 0;
	background-color: #007bff;
	border-color: #007bff;
   float: right;
}

/* Styliser le bouton d'enregistrement lorsqu'il est survolé */
.btn-primary:hover {
	background-color: #0069d9;
	border-color: #0062cc;
   float: right;
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
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Ajouter groupe</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ajouter groupe</li>
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
             <h3 class="card-title">Groupe Information</h3>
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <form method="POST">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
           Groupe Information
        </div>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group">
          <label for="teacherName">Nom du Formateur</label>
          <select class="form-control" id="teacherName" name="teacherName">
            <?php
              // Connect to the databas
               // Query the database for teacher names
            $sq = "SELECT nom   FROM formateur";
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
          <label for="teacherName">Nom du Formation</label>
          <select class="form-control" id="formation" name="formation">
            <?php
            $s = "SELECT nom  FROM formations";
            $resu = mysqli_query($conn, $s);
              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resu) > 0) {
                while($ro = mysqli_fetch_assoc($resu)) {
                  echo "<option>" . $ro["nom"] . "</option>";
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
          <label for="groupName">Nom du groupe</label>
          <input type="text" class="form-control" id="groupName" name="groupName" placeholder="Enter group name">
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