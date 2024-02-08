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

    // Récupération des données du formulaire
    $matiere = $_POST['matiere'];
    $enseignant = $_POST['enseignant'];
    $class = $_POST['class'];
    $salle = $_POST['salle'];
    $jour = $_POST['jour'];
    $heure_debut = $_POST['heure_debut'];
    $heure_fin = $_POST['heure_fin'];// Assuming you have the secretary ID stored in the session

    // Retrieve etudiant_id from etudiant table
    $stmt = $conn->prepare("SELECT id FROM class WHERE nom = ?");
    $stmt->bind_param("s", $class);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $class_id = $row['id'];

      // Retrieve formation_id from formation table
      $stmt = $conn->prepare("SELECT id FROM formations WHERE nom = ?");
      $stmt->bind_param("s", $matiere);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $formation_id = $row['id'];

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO emploidutemp ( enseignant, salle, jour, heure_debut, heure_fin,class_id,formation_id) VALUES (?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("sssssii", $enseignant, $salle, $jour,$heure_debut,$heure_fin,$class_id, $formation_id);

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
      <title>ressource</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <style>

               h1 {
           text-align: center;
           margin-top: 30px;
           color: crimson;
         }
         .tit{
            text-align: center;
            margin-top: 40px;
         }
         /* Style pour le formulaire d'ajout de certification */
         .form-group label {
           font-weight: bold;
         }
         form {
           max-width: 600px;
           margin: 0 auto;
           margin-top: 30px;}
               .form-group {
                  margin-bottom: 15px;
               }
               .form-group label {
                  font-weight: bold;
               }
               .form-control {
                  border-radius: 5px;
                  border: 1px solid #ccc;
                  padding: 8px;
                  width: 100%;
                  margin-bottom: 15px;
               }
               button[type="submit"] {
                  margin-top: 15px;
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
				<label for="matiere">Matière :</label>
            <select class="form-control" name="matiere">
                <?php
                // Retrieve students from database
                $sql = "SELECT * FROM formations ";
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
          <div class="col-md-6">
          <div class="form-group">
				<label for="enseignant">Enseignant :</label>
				<select class="form-control" name="enseignant">
                <?php
                // Retrieve students from database
                $sql = "SELECT * FROM formateur ";
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
          <div class="col-md-6">
          <div class="form-group">
				<label for="salle">Salle :</label>
            <select class="form-control" name="salle">
                <?php
                // Retrieve students from database
                $sql = "SELECT * FROM ressource where type_r ='Salle de réunion' ";
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
          <div class="col-md-6">
          <div class="form-group">
				<label for="jour">Jour :</label>
				<input type="date" class="form-control" name="jour" id="jour">
			</div>
          </div>
          
          <div class="col-md-12">
          <div class="form-group">
				<label for="heure_debut">Heure de début :</label>
				<input type="time" class="form-control" name="heure_debut" id="heure_debut">
			</div>
          </div>
          <div class="col-md-12">
          <div class="form-group">
				<label for="heure_fin">Heure de fin :</label>
				<input type="time" class="form-control" name="heure_fin" id="heure_fin">
			</div>
          </div>
          <div class="col-md-12">
          <div class="form-group">
				<label for="heure_fin">Groupe :</label>
				<select class="form-control" name="class">
                <?php
                // Retrieve students from database
                $sql = "SELECT * FROM class ";
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