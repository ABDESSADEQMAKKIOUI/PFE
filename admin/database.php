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
  
// Database configuration
$host = 'localhost';
$db = 'test';
$user = 'root';
$password = '';

// Backup destination directory
$backupDir = '/path/to/backup/directory/';

// Generate a unique filename for the backup
$backupFile = $backupDir . 'backup_' . date('Y-m-d_H-i-s') . '.sql';

// Execute the database backup
exec("mysqldump --user={$user} --password={$password} --host={$host} {$db} > {$backupFile}", $output, $returnVar);

// Check if the backup was successful
if ($returnVar === 0) {
    echo "Database backup created successfully!";
} else {
    echo "Error creating database backup: " . implode("\n", $output);
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>backup data</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
      <link rel="stylesheet" href="../asset/css/style.css">

   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
      include_once('includes/sidebar.php');?>
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(242,175,88);"><span class="fa fa-database"></span> Backup Database</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Database</li>
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
                     <h3 class="card-title">Database Information</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="card-header">
                                 <span class="fa fa-user"> Database Information</span>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">Backup Name</label>
                                       <input type="email" class="form-control" placeholder="backup name">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">Backup Date</label>
                                       <input type="date" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                     <!-- /.card-body -->

                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Backup</button>
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