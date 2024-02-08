<?php
// Connexion à la base de données
session_start();
$dsn = 'mysql:host=localhost;dbname=test';
$username = 'root';
$password = '';
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{

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
      <div class="container">
      <h1>Edit Group</h1>
      <?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "test");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$formationName = '';
$formateurName = '';
$groupName = '';

// Retrieve group information from the database
$id = $_GET['id'];
$sql = "SELECT c.id, f.nom AS formation_name, fo.nom AS formateur_name, c.nom AS group_name
        FROM class c
        INNER JOIN class_formateur cf ON c.id = cf.class_id
        INNER JOIN class_formation cfo ON c.id = cfo.class_id
        INNER JOIN formations f ON cfo.formation_id = f.id
        INNER JOIN formateur fo ON cf.formateur_id = fo.id
        WHERE c.id = $id";
$result = mysqli_query($conn, $sql);

// Check if the group exists in the database
if ($result && mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
  $formationName = $row['formation_name'];
  $formateurName = $row['formateur_name'];
  $groupName = $row['group_name'];

  // Update group information in the database
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formationName = $_POST['formationName'];
    $formateurName = $_POST['formateurName'];
    $groupName = $_POST['groupName'];

    // Update the group information in the database using appropriate table updates
    $sqlFormationId = "UPDATE class_formation SET id_formation = (SELECT id FROM formation WHERE nom = '$formationName') WHERE id_class = $id";

    // Update the formateur id in the class_formateur table
    $sqlFormateurId = "UPDATE class_formateur SET id_formateur = (SELECT id FROM formateur WHERE nom = '$formateurName') WHERE id_class = $id";

    // Update the group name in the class table
    $sqlGroupName = "UPDATE class SET nom = '$groupName' WHERE id = $id";

    // Execute the update queries
    if (mysqli_query($conn, $sqlFormationId) && mysqli_query($conn, $sqlFormateurId) && mysqli_query($conn, $sqlGroupName)) {
      echo "Group information updated successfully.";
    } else {
      echo "Error updating group information: " . mysqli_error($conn);
    }

    echo "Group information updated successfully.";
  }
} else {
  echo "Group not found in the database.";
}

// Close the database connection
mysqli_close($conn);
?>

<form method="post">
  <div class="form-group">
    <label for="formationName">Formation Name:</label>
    <input type="text" class="form-control" name="formationName" id="formationName" value="<?php echo $formationName; ?>">
  </div>

  <div class="form-group">
    <label for="formateurName">Formateur Name:</label>
    <input type="text" class="form-control" name="formateurName" id="formateurName" value="<?php echo $formateurName; ?>">
  </div>

  <div class="form-group">
    <label for="groupName">Group Name:</label>
    <input type="text" class="form-control" name="groupName" id="groupName" value="<?php echo $groupName; ?>">
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>




</div>
>
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