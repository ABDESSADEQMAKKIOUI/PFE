<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(strlen($_SESSION['name'])==0)
{ 
    header('location:authentic.php');
}
else {
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare SQL query
    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
    $sql = "SELECT * FROM formateur WHERE nom LIKE '%$search_query%' OR prenom LIKE '%$search_query%'  OR email LIKE '%$search_query%'";
    
    $result = mysqli_query($conn, $sql);
    
    // Check if there are any results
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Close the database connection


?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>gérer formateur</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <!-- DataTables -->
            <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="../asset/tables/datatables-responsive/css/responsive.bootstrap4.min.css">
            <link rel="stylesheet" href="../asset/tables/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
      body {
         font-family: Arial, sans-serif;
      }
      

      .content-wrapper {
         margin-left: 250px; /* Adjust this value to match your sidebar width */
         padding: 20px;
      }

      h1 {
         margin-top: 0;
         font-size: 24px;
      }

      .form-group {
         margin-bottom: 20px;
      }

      label {
         font-weight: bold;
      }

      input[type="text"],
      input[type="email"] {
         width: 100%;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 4px;
         box-sizing: border-box;
      }

      button[type="submit"] {
         background-color: #007bff;
         color: #fff;
         padding: 10px 20px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         font-size: 16px;
      }

      button[type="submit"]:hover {
         background-color: #0069d9;
      }

      table {
         width: 50%;
         border-collapse: collapse;
         margin-bottom: 20px;
      }

      th,
      td {
         padding: 8px;
         text-align: left;
         border-bottom: 1px solid #ddd;
      }
      th {
         padding: 8px;
         text-align: left;
         border-bottom: 1px solid #ddd;
         text-align: center;
      }

      .card-body {
         animation-duration: 1s;
         animation-fill-mode: both;
         animation-name: pulse;
      }

      @keyframes pulse {
         0% {
            transform: scale(1);
         }
         50% {
            transform: scale(1.05);
         }
         100% {
            transform: scale(1);
         }
      }

      .btn-sm {
         margin-left: 20%;
      }

      /* Breadcrumb styles */
      .breadcrumb {
         margin-bottom: 0;
         background-color: #f8f9fa;
         padding: 8px 16px;
         border-radius: 4px;
      }

      .breadcrumb-item {
         font-size: 14px;
         color: #333;
      }

      .breadcrumb-item a {
         text-decoration: none;
         color: #333;
      }

      .breadcrumb-item.active {
         color: #007bff;
      }

      /* Modal styles */
      .delete-modal {
         display: flex;
         align-items: center;
         justify-content: center;
         background-color: rgba(0, 0, 0, 0.5);
         display: none;
      }

      .modal-dialog-centered {
         margin: 0;
         display: flex;
         align-items: center;
         justify-content: center;
         height: 100%;
      }

      .modal-content {
         width: 400px;
         padding: 20px;
         text-align: center;
      }

      .modal-body {
         padding-bottom: 20px;
      }

      .modal-body img {
         width: 50px;
         height: 46px;
         margin-bottom: 20px;
      }

      .modal-body h3 {
         margin-top: 0;
      }

      .modal-body .m-t-20 {
         margin-top: 20px;
      }

      .modal-body .btn {
         margin-right: 10px;
      }

      /* Animation styles */
      @keyframes rubberBand {
         from {
            transform: scale3d(1, 1, 1);
         }

         30% {
            transform: scale3d(1.25, 0.75, 1);
         }

         40% {
            transform: scale3d(0.75, 1.25, 1);
         }

         50% {
            transform: scale3d(1.15, 0.85, 1);
         }

         65% {
            transform: scale3d(0.95, 1.05, 1);
         }

         75% {
            transform: scale3d(1.05, 0.95, 1);
         }

         to {
            transform: scale3d(1, 1, 1);
         }
      }

      .rubberBand {
         animation-name: rubberBand;
      }
   </style>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         <?php
           include_once('includes/sidebar.php');?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
         <!-- Content Header (Page header)-->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0"><span class="fa fa-users"></span>liste des Formateurs  </h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Formateurs</li>
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
               <form method="post" style="width:30%; float: right;margin-right:5px;" class="row">
    <div class="cmd-col-6">
        <input type="text" name="search_query" id="search_query" class="form-control">
    </div>
    <div class="cmd-col-6" style="margin-right:5px;"><button type="submit" class="btn btn-primary btn-sm" >Chercher</button></div>
    <div class="cmd-col-6"><button type="submit" class="btn btn-primary btn-sm">Ajouter</button></div>
    
</form>

                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                        <th>#</th>
                           <th>Nom</th>
                           <th>Prenom</th>
                           <th>Email</th>
                          
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php
if (mysqli_num_rows($result) > 0) {
   // Output data of each row
   while($row = mysqli_fetch_assoc($result)) {
      
       // Execute the SQL 
       // Check if the query was successful
       // Form the table row
       echo "<tr>";
       echo "<th scope='row'>" . $row["id"] . "</th>";
       echo "<td>" . $row['nom'] . "</td>";
       echo "<td>" . $row['prenom'] . "</td>";
       echo "<td>" . $row['email'] . "</td>";
       echo "<td>";
       echo "<a href='edit_formateur.php?id=" . $row["id"] . "'><button type='button' class='btn btn-primary btn-sm' style='margin-left:20%'>Modifier</button></a>";
       echo "<button type='button' class='btn btn-danger btn-sm delete-btn' style='margin-left:20%'>Supprimer</button>";
       echo "</td>";
       echo "</tr>";
      $idd= $row["id"];
   }



?>

                    
                       
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- ./wrapper -->
   <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body text-center">
                  <img src="../asset/img/sent.png" alt="" width="50" height="46">
                  <h3>Are you sure you want to delete this Student?</h3>
                  <div class="m-t-20">
                     <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                     <?php
                     echo "<a href='delete_formateur.php?delete_id=" . $idd . "'><button type='button' class='btn btn-danger btn-sm' style='marrgin-left:20%'>Supprimer</button></a>";
                  

 
}
else {
   echo "<tr><td colspan='6'>No results found.</td></tr>";
}



?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
      $(document).ready(function() {
         // Show the delete form when clicking on the "Supprimer" button
         $(".delete-btn").on("click", function() {
            $("#delete").fadeIn();
         });
      });
   </script>
   </body>
</html>
<?php } ?>   