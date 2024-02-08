<?php
session_start();
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=test';
$username = 'root';
$password = '';
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{
try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
// Récupération des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    // Insertion des données dans la base de données
    $sql = "INSERT INTO secretaires (nom, prenom, email, telephone, adresse) VALUES (:nom, :prenom, :email, :telephone, :adresse)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->execute();

    echo "Le secrétaire a été ajouté avec succès !";
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
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Ajouter Secrétaire</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ajouter Secrétaire</li>
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
             <h3 class="card-title">Formulaire d'ajoute</h3>
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <form method="POST">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
           Secrétaire Informations
        </div>
        <div class="row">
        <div class="col-md-6">
    <label for="nom" class="form-label">Nom :</label>
    <input type="text" name="nom" id="nom" class="form-control">
  </div>

  <div class="col-md-6">
    <label for="prenom" class="form-label">Prénom :</label>
    <input type="text" name="prenom" id="prenom" class="form-control">
  </div>

  <div class="col-md-6">
    <label for="email" class="form-label">Email :</label>
    <input type="email" name="email" id="email" class="form-control">
  </div>

  <div class="col-md-6">
    <label for="telephone" class="form-label">Téléphone :</label>
    <input type="tel" name="telephone" id="telephone" class="form-control">
  </div>

  <div class="col-12">
    <label for="adresse" class="form-label">Adresse :</label>
    <input type="text" name="adresse" id="adresse" class="form-control">
  </div>

  

        </div>
      </div>
    </div>
  </div>
  <div class="card-footer">
  <button type="submit" class="btn btn-primary">Ajouter</button>
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