<?php
// Function to delete a payment
function deleteressource($conn, $ressourceId) {
  // Prepare the delete statement
  $stmt = $conn->prepare("DELETE FROM ressource WHERE id = ?");
  $stmt->bind_param("i", $ressourceId);

  // Execute the delete statement
  if ($stmt->execute()) {
    echo "Payment deleted successfully.";
  } else {
    echo "Error deleting payment: " . $stmt->error;
  }

  // Close the statement
  $stmt->close();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (isset($_GET['delete_id'])) {
    $ressource_id = $_GET['delete_id'];
}
deleteressource($conn,$ressource_id);
header('location:gérer_ressource.php');
?>
