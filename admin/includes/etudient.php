<?php

class Etudiant {
  private $id;
  private $first_name;
  private $middle_name;
  private $last_name;
  private $gender;
  private $birthday;
  private $contact;
  private $email;
  private $address;
  private $username;
  private $password;
  private $conn;

  function __construct($conn) {
    $this->conn = $conn;
  }

  public function addEtudiant($data) {
    // Retrieve form data
    $this->first_name = $data['first_name'];
    $this->middle_name = $data['middle_name'];
    $this->last_name = $data['last_name'];
    $this->gender = $data['gender'];
    $this->birthday = $data['birthday'];
    $this->contact = $data['contact'];
    $this->email = $data['email'];
    $this->address = $data['address'];
    $this->username = $data['username'];
    $this->password = $data['password'];

    // Prepare SQL statement
    $stmt = $this->conn->prepare("INSERT INTO users (first_name, middle_name, last_name, gender, birthday, contact, email, address, username, PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $this->first_name, $this->middle_name, $this->last_name, $this->gender, $this->birthday, $this->contact, $this->email, $this->address, $this->username, $this->password);

    // Execute SQL statement
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }

    // Close statement and connection
    $stmt->close();
  }

  public function modifyEtudiant($id, $data) {
    // Retrieve form data
    $this->first_name = $data['first_name'];
    $this->middle_name = $data['middle_name'];
    $this->last_name = $data['last_name'];
    $this->gender = $data['gender'];
    $this->birthday = $data['birthday'];
    $this->contact = $data['contact'];
    $this->email = $data['email'];
    $this->address = $data['address'];
    $this->username = $data['username'];
    $this->password = $data['password'];

    // Prepare SQL statement
    $stmt = $this->conn->prepare("UPDATE users SET first_name = ?, middle_name = ?, last_name = ?, gender = ?, birthday = ?, contact = ?, email = ?, address = ?, username = ?, PASSWORD = ? WHERE id = ?");
    $stmt->bind_param("ssssssssssi", $this->first_name, $this->middle_name, $this->last_name, $this->gender, $this->birthday, $this->contact, $this->email, $this->address, $this->username, $this->password, $id);

    // Execute SQL statement
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }

    // Close statement and connection
    $stmt->close();
  }

  public function deleteEtudiant($id) {
    $query = "DELETE FROM etudiant WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
  ?>
