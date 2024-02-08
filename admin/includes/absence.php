<?php
session_start();

class Absence {
  private $conn;

  function __construct() {
    // Create connection
    $this->conn = mysqli_connect("localhost", "root", "", "test");

    // Check connection
    if (!$this->conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
  }

  function add_absence() {
    // Process form data and insert into database
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_absence'])) {
      // Retrieve form data
      $nom_etudiant = $_POST['nom_etudiant'];
      $id_etudiant = $_POST['id_etudiant'];
      $formation = $_POST['formation'];
      $date_a = $_POST['date_a'];
      $heure = $_POST['heure'];

      // Prepare SQL statement
      $stmt = $this->conn->prepare("INSERT INTO Absence (etudiant, code, formation, date_a, heure) VALUES (?, ?, ?, ?, ?)");
      if (!$stmt) {
        die("Error preparing SQL statement: " . $this->conn->error);
      }

      // Bind parameters
      $stmt->bind_param("sssss", $nom_etudiant, $id_etudiant, $formation, $date_a, $heure);

      // Execute SQL statement
      if ($stmt->execute()) {
        echo "Data successfully inserted into database.";
      } else {
        echo "Error inserting data into database: " . $this->conn->error;
      }

      // Close statement
      $stmt->close();
    }
  }

  function delete_absence($id) {
    // Prepare SQL statement
    $stmt = $this->conn->prepare("DELETE FROM Absence WHERE id = ?");
    if (!$stmt) {
      die("Error preparing SQL statement: " . $this->conn->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute SQL statement
    if ($stmt->execute()) {
      echo "Data successfully deleted from database.";
    } else {
      echo "Error deleting data from database: " . $this->conn->error;
    }

    // Close statement
    $stmt->close();
  }

  function modify_absence($id, $nom_etudiant, $id_etudiant, $formation, $date_a, $heure) {
    // Prepare SQL statement
    $stmt = $this->conn->prepare("UPDATE Absence SET etudiant=?, code=?, formation=?, date_a=?, heure=? WHERE id=?");
    if (!$stmt) {
      die("Error preparing SQL statement: " . $this->conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssi", $nom_etudiant, $id_etudiant, $formation, $date_a, $heure, $id);

    // Execute SQL statement
    if ($stmt->execute()) {
      echo "Data successfully modified in database.";
    } else {
      echo "Error modifying data in database: " . $this->conn->error;
    }

    // Close statement
    $stmt->close();
  }

  function __destruct() {
    // Close connection
    $this->conn->close();
  }
}

// Check authentication
if (strlen($_SESSION['name']) == 0) { 
  header('location:authentic.php');
} else {
  $absence = new Absence();

  // Add absence if form data is submitted
  if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $absence->add_absence();
    }
    
    // Delete absence if delete button is clicked
    if (isset($_GET['delete_id'])) {
    $absence->delete_absence($_GET['delete_id']);
    }
    
    // Modify absence if modify button is clicked and form data is submitted
    if (isset($_POST['modify_absence'])) {
    $id = $_POST['id'];
    $nom_etudiant = $_POST['nom_etudiant'];
    $id_etudiant = $_POST['id_etudiant'];
    $formation = $_POST['formation'];
    $date_a = $_POST['date_a'];
    $heure = $_POST['heure'];
    $absence->modify_absence($id, $nom_etudiant, $id_etudiant, $formation, $date_a, $heure);
    }
    }
    ?>
