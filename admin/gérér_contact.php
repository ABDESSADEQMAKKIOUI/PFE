<?php
// Create connection
session_start();
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
      <div class="container" style="text-align: center; margin-left: 24%;">
    <h1>List of message</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>nom</th>
                <th>email</th>
                <th>subject</th>
                <th>message</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Create connection
                $servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Select messages from the database and order by date
$sql = "SELECT * FROM contact_form_data ORDER BY date_created DESC";
$result = mysqli_query($conn, $sql);

                // Check if query was successful
                if (!$result) {
                    die("Error retrieving data from database: " . mysqli_error($conn));
                }

                // Output data of each row
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" .$row["name"]. "</td>";
                    echo "<td>" . $row["email"]  . "</td>";
                    echo "<td>" . $row["subject"]. "</td>";
                    echo "<td>" . $row["message"]. "</td>";
                    echo "<td>" .  $row["date_created"]. "</td>";
                    
                    echo "</tr>";
                }
            
        } else {
          echo "No messages found.";
        }

                // Close connection
                mysqli_close($conn);
            ?>
        </tbody>
    </table>
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
<?php } ?>