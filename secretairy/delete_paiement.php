<?php
// Function to delete a payment
function deletePayment($conn, $paymentId) {
  // Prepare the delete statement
  $stmt = $conn->prepare("DELETE FROM paiement WHERE id = ?");
  $stmt->bind_param("i", $paymentId);

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
    $paiement_id = $_GET['delete_id'];
}
deletePayment($conn,$paiement_id);
header('location:gérer_paiement.php');
?>
