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
else {
   
    // Delete Certificat
    if (isset($_GET['delete_id'])) {
        $certificat_id = $_GET['delete_id'];
        
        // Prepare the SQL statement
        $delete_sql = "DELETE FROM formations WHERE id = $certificat_id";

        // Execute the SQL statement
        if (mysqli_query($conn, $delete_sql)) {
            header('location:gérer_formation.php');
        } else {
            echo "Error deleting certificat: " . mysqli_error($conn);
        }
    }
}
?>
