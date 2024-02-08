<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");
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
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Liste d'absences</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Absence</li>
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
         <div class="row">
         <div class="col-md-6">
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info">
           <div class="card-header" style="text-align: center;">
             <h3 class="card-title">Liste d'bsences des étudiants</h3>
             <a href="ajouter_absence.php" style="float: right;"><button class="text-center btn btn-info btn-block" type="submit">Ajouter</button></a> 
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <table class="table table-bordered">
        <thead>
            <tr>
            <th>#</th>
                <th>Nom </th>
                <th>Date</th>
                <th>Heure</th>
                <th>formation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from database
$sql = "SELECT * FROM absence where type_a = 'etudiant' ";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if (!$result) {
    die("Error retrieving data from database: " . mysqli_error($conn));
}

// Output data of each row
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["nom"] . "</td>";
    echo "<td>" . $row["date_a"] . "</td>";
    echo "<td>" . $row["heure"] . "</td>";
    echo "<td>" . $row["formation"] . "</td>";
    echo "<td><a href='delete_absence.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a></td>";
    echo "</tr>";
}

// Close connection
mysqli_close($conn);
?>

        </tbody>
    </table>
    </div></div>
         </section>
         </div>
         <div class="col-md-6">
         <section class="content">
            <div class="container-fluid">
               <div class="card card-info">
           <div class="card-header" style="background-color: crimson;text-align: center;">
             <h3 class="card-title">Liste d'bsences des formateurs</h3>
             <a href="ajouter_absence.php" style="float: right;"><button class="text-center btn btn-info btn-block" type="submit">Ajouter</button></a> 
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom </th>
                <th>Date</th>
                <th>Heure</th>
                <th>formation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from database
$sql = "SELECT * FROM absence where type_a = 'formateur' ";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if (!$result) {
    die("Error retrieving data from database: " . mysqli_error($conn));
}

// Output data of each row
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["nom"] . "</td>";
    echo "<td>" . $row["date_a"] . "</td>";
    echo "<td>" . $row["heure"] . "</td>";
    echo "<td>" . $row["formation"] . "</td>";
    echo "<td><a href='delete_absence.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a></td>";
    echo "</tr>";
}

// Close connection
mysqli_close($conn);
?>

        </tbody>
    </table>
    </div>
    </div>
         </section>
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
<?php } ?>