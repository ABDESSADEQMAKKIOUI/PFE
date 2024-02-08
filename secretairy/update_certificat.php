<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (strlen($_SESSION['name']) == 0) {
    header('location:authentic.php');
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $certificat_id = $_POST['certificat_id'];

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve the certificat record from the database
        $sql = "SELECT * FROM certificat WHERE id = $certificat_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // Display a form with the existing certificat details for updating
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Certificat</title>
            <!-- Add your CSS styling here -->
        </head>
        <body>
            <h2>Update Certificat</h2>
            <form method="POST" action="process_update_certificat.php">
                <input type="hidden" name="certificat_id" value="<?php echo $row['id']; ?>">
                <label for="formation">Nom de la certification:</label>
                <input type="text" name="formation" id="formation" value="<?php echo $row['formation']; ?>">
                <br>
                <label for="etudiant">Étudiant:</label>
                <input type="text" name="etudiant" id="etudiant" value="<?php echo $row['etudiant']; ?>">
                <br>
                <label for="date_obtention">Date d'obtention:</label>
                <input type="date" name="date_obtention" id="date_obtention" value="<?php echo $row['date_c']; ?>">
                <br>
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    }
}
?>
