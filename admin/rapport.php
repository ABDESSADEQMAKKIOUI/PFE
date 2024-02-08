<?php
// Connect to the database
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{
$search_query = $_POST['search_query'];

 // Create a connection to the database
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 
 // Check if the connection was successful
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 
 // Prepare the SQL statement
 $sql = "SELECT * FROM rapport WHERE formation LIKE '%$search_query%' OR date_f LIKE '%$search_query%'";
 
 // Execute the SQL statement
 $result = mysqli_query($conn, $sql);
 
 // Check if the query was successful
 if (!$result) {
     die("Query failed: " . mysqli_error($conn));
 }
 

?>
<!DOCTYPE html>
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
               body {
                  font-family: Arial, sans-serif;
               }
         
               .container {
                  display: flex;
                  flex-direction: column;
                  align-items: center;
                  padding: 20px;
               }
         
               .header {
                  margin-bottom: 20px;
                  font-size: 24px;
                  font-weight: 700;
                  color: #333;
                  text-align: center;
                  margin-top: 60px;
               }
         
               .table-container {
                  width: 80%;
                  margin-bottom: 20px;
                  float: right;
                  margin-right: 100px;
                  margin-top: 150px;
               }
         
               table {
                  width: 100%;
                  border-collapse: collapse;
               }
         
               table th, table td {
                  padding: 10px;
                  text-align: left;
                  border: 1px solid #ccc;
               }
         
               table th {
                  background-color: #f1f1f1;
                  font-weight: 700;
                  color: #333;
               }
         
               table tr:hover {
                  background-color: #f1f1f1;
               }
         
               .footer {
                  display: flex;
                  align-items: center;
                  justify-content: center;
               }
         
               .footer a {
                  background-color: #333;
                  color: #ccc;
                  padding: 10px 20px;
                  border: none;
                  border-radius: 5px;
                  cursor: pointer;
                  text-decoration: none;
                  font-weight: 700;
                  text-transform: uppercase;
                  transition: background-color 0.3s ease-in-out;
               }
         
               .footer a:hover {
                  background-color: #666;
               }
            </style>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
           include_once('includes/sidebar.php');?>
            <section style="background-color: #eee; width: 81%; float: right;">
            <div class="header">Rapports de paiement des formations</div>
            <div class="table-container">
               <table>
                  <thead>
                     <tr>
                        <th>Formation</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Rapport de paiement</th>
                     </tr>
                  </thead>
                  <tbody>
    <?php
 
 // Check if any rows were returned
 if (mysqli_num_rows($result) > 0) {
     // Output data of each row
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr>";
         echo "<th scope='row'>" . $row["id"] . "</th>";
         echo "<td>" . $row['formation'] . "</td>";
         echo "<td>" . $row['date_d'] . "</td>";
         echo "<td>" . $row['date_f'] . "</td>";
         echo "<td>" . $row['rapport'] . "</td>";
         echo "</tr>";
     }
 } else {
     echo "0 results";
 }
 
 // Close the connection
 mysqli_close($conn);
    ?>
  </tbody>
               </table>
            </div>
               </section>
            </div>
            <!-- /.card -->
         </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php }?>