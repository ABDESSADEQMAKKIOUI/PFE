<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");
if(strlen($_SESSION['name']) == 0) {
  header('location:authentic.php');
} else {
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Process form data and insert into database
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['formation'];
    $date_f = $_POST['date_f'];
    $formateur = $_POST['formateur'];
    $domain = $_POST['domain'];
    $prix = $_POST['prix'];
    $durée = $_POST['duree'];
    $description = $_POST['description'];

    // Retrieve formateur_id based on formateur name
    $stmt = $conn->prepare("SELECT * FROM formateur WHERE nom = ?");
    $stmt->bind_param("s", $formateur);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $formateur_id = $row['id'];

      // Prepare SQL statement to insert into formations table
      $stmt = $conn->prepare("INSERT INTO formations (nom, date_f,  domain, prix, duree, description) VALUES ( ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssss", $name, $date_f, $domain, $prix, $durée, $description);

      // Execute SQL statement
      if ($stmt->execute()) {
        // Retrieve the formation_id of the inserted row
        $formation_id = $stmt->insert_id;

        // Prepare SQL statement to insert into formation_formateur table
        $stmt = $conn->prepare("INSERT INTO formation_formateur (formation_id, formateur_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $formation_id, $formateur_id);

        // Execute SQL statement
        if ($stmt->execute()) {
          echo "Data successfully inserted into database.";
        } else {
          echo "Error inserting data into database: " . $conn->error;
        }
      } else {
        echo "Error inserting data into database: " . $conn->error;
      }

      // Close statement and connection
      $stmt->close();
    } else {
      echo "Formateur not found in the database.";
    }
  }

  // Close connection



?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>formation</title>
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
                        <h1 class="m-0"><span class="fa fa-book"></span>  Ajouter Formation</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Ajouter formation</li>
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
                <h3 class="card-title">Formation Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-12">
                     <div class="card-header">
                        <span class="fa fa-book"> Formation Information</span>
              </div>
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" id="date_f" name="date_f">
                  </div>
               </div>
              
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Durée</label>
                    <input type="text" class="form-control" id="duree" name="duree">
                  </div>
               </div>
                  <div class="col-md-6">
                  <div class="form-group">
                        <label>Dommain</label>
                        <select class="form-control" name="domain" id="domain">
                          <option>Industrie et commerce</option>
                          <option>Informatique et technologie</option>
                          <option>Gestion et administration des affaires</option>
                          <option>Santé et médecine</option>
                          <option>Éducation et formation des enseignants </option>
                          <option>Art et design</option>
                          <option>Langues étrangères et communication interculturelle</option>
                          <option>Droit et justice</option>
                          <option>Environnement et développement durable</option>
                          <option>Sciences sociales et humaines</option>
                        </select>
                      </div>
               </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Formateur</label>
                    <select class="form-control" name="formateur">
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
                    <label>Prix</label>
                    <input type="text" class="form-control" placeholder="amount" name="prix" id="prix" >
                  </div>
               </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label>Nom de formation</label>
                    <input type="text" class="form-control" placeholder="donner le nom de formation" name="formation" id="formation">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" placeholder="donner un description sur la formation" name="description" id="description">
                  </div>
               </div>
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