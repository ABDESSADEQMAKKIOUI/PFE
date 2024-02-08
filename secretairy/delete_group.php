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
function deleteGroup($groupId) {
  // Create connection
  $conn = mysqli_connect("localhost", "root", "", "test");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Delete from class table
  $stmt1 = $conn->prepare("DELETE FROM class WHERE id = ?");
  if (!$stmt1) {
    die("Error preparing SQL statement 1: " . $conn->error);
  }
  $stmt1->bind_param("i", $groupId);
  if ($stmt1->execute()) {
    $stmt1->close();
  } else {
    die("Error deleting data from class table: " . $stmt1->error);
  }

  // Delete from class_formateur table
  $stmt2 = $conn->prepare("DELETE FROM class_formateur WHERE class_id = ?");
  if (!$stmt2) {
    die("Error preparing SQL statement 2: " . $conn->error);
  }
  $stmt2->bind_param("i", $groupId);
  if ($stmt2->execute()) {
    $stmt2->close();
  } else {
    die("Error deleting data from class_formateur table: " . $stmt2->error);
  }

  // Delete from class_formation table
  $stmt3 = $conn->prepare("DELETE FROM class_formations WHERE class_id = ?");
  if (!$stmt3) {
    die("Error preparing SQL statement 3: " . $conn->error);
  }
  $stmt3->bind_param("i", $groupId);
  if ($stmt3->execute()) {
    $stmt3->close();
  } else {
    die("Error deleting data from class_formation table: " . $stmt3->error);
  }

  // Close the connection
  $conn->close();
}
if (isset($_GET['delete_id'])) {
    $group_id = $_GET['delete_id'];
}
deleteGroup( $group_id);
header('location:gérer_group.php');

}
?>
