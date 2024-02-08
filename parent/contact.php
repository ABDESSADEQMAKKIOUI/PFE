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
else{
// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Retrieve the form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Insert the form data into the database
$sql = "INSERT INTO reclamation (name, email, subject, message, date_created) VALUES ('$name', '$email', '$subject', '$message', NOW())";

if (mysqli_query($conn, $sql)) {
    echo "Form data submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
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
            <link rel="stylesheet" href="css/style.css">
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
           include_once('includes/sidebar.php');?>
<section class="contact-page spad pb-0" style="width: 80%; float: right; margin-top: -60px;">
                     <div style="text-align: center;">
                        <h2 style="color: crimson; font-size: 30px; font-weight: bold;">contacter adminitstrateur</h2>
                     </div>
                     <div class="container">
                        
                                 <form class="contact-form" method="post">
                                    <input type="text" placeholder="Your Name" name="name">
                                    <input type="text" placeholder="Your E-mail" name="email">
                                    <input type="text" placeholder="Subject" name="subject">
                                    <textarea placeholder="Message" name="message"></textarea>
                                    <button type="submit" class="site-btn" style="float: right;">Sent Message</button>
                                 </form>
                           
                     </div>
                  </section>
                  <!-- Page end -->
       
            </div>
            <!-- /.card -->
         </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php } ?>  