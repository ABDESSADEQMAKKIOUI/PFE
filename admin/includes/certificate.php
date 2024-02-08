<?php

class Certificate {
  private $conn;
  private $id;
  private $nom_etudiant;
  private $id_etudiant;
  private $formation;
  private $date_a;

  function __construct($nom_etudiant, $id_etudiant, $formation, $date_a) {
    // Create connection
    $this->conn = mysqli_connect("localhost", "root", "", "test");

    // Check connection
    if (!$this->conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Set object attributes
    $this->nom_etudiant = $nom_etudiant;
    $this->id_etudiant = $id_etudiant;
    $this->formation = $formation;
    $this->date_a = $date_a;
  }

  function getId() {
    return $this->id;
  }

  function getNomEtudiant() {
    return $this->nom_etudiant;
  }

  function getIdEtudiant() {
    return $this->id_etudiant;
  }

  function getFormation() {
    return $this->formation;
  }

  function getDateA() {
    return $this->date_a;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setNomEtudiant($nom_etudiant) {
    $this->nom_etudiant = $nom_etudiant;
  }

  function setIdEtudiant($id_etudiant) {
    $this->id_etudiant = $id_etudiant;
  }

  function setFormation($formation) {
    $this->formation = $formation;
  }

  function setDateA($date_a) {
    $this->date_a = $date_a;
  }

  function add_certificate() {
    // Prepare SQL statement
    $stmt = $this->conn->prepare("INSERT INTO certificat (etudiant, code, formation, date_c) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
      die("Error preparing SQL statement: " . $this->conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $this->nom_etudiant, $this->id_etudiant, $this->formation, $this->date_a);

    // Execute SQL statement
    if ($stmt->execute()) {
      echo "Data successfully inserted into database.";
    } else {
      echo "Error inserting data into database: " . $this->conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $this->conn->close();
  }

  function delete_certificate() {
    // Prepare SQL statement
    $stmt = $this->conn->prepare("DELETE FROM certificat WHERE id = ?");
    if (!$stmt) {
      die("Error preparing SQL statement: " . $this->conn->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $this->id);

    // Execute SQL statement
    if ($stmt->execute()) {
      echo "Data successfully deleted from database.";
    } else {
      echo "Error deleting data from database: " . $this->conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $this->conn->close();
  }

  public function modify_cer($id, $nom_etudient, $id_etudient, $formation, $date_a) {
   
    // Prepare SQL statement
    $stmt = $this->conn->prepare("UPDATE certificat SET etudiant=?, code=?, formation=?, date_c=? WHERE id=?");
    if (!$stmt) {
      die("Error preparing SQL statement: " . $this->conn->error);
    }
  
    // Bind parameters
    $stmt->bind_param("ssssi", $nom_etudient, $id_etudient, $formation, $date_a, $id);
  
    // Execute SQL statement
    if ($stmt->execute()) {
      echo "Certificate with ID $id successfully updated in database.";
    } else {
      echo "Error updating certificate in database: " . $this->conn->error;
    }
  
    // Close statement and connection
    $stmt->close();
    $this->conn->close();
}

  public function show_certificates() {
    $conn = $this->conn;
    $sql = "SELECT * FROM certificat";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Nom etudient: " . $row["etudiant"]. " - Code: " . $row["code"]. " - Formation: " . $row["formation"]. " - Date: " . $row["date_c"]. "<br>";
        }
    } else {
        echo "0 results";
    }
}

}
?>  