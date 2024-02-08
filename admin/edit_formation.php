<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve formation data based on the formation_id parameter
if (isset($_GET['id'])) {
  $formation_id = $_GET['id'];

  // Prepare SQL statement
  $stmt = $conn->prepare("SELECT * FROM formations WHERE id = ?");
  $stmt->bind_param("i", $formation_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $name = $row['nom'];
    $date_f = $row['date_f'];
    $domain = $row['domain'];
    $prix = $row['prix'];
    $durée = $row['duree'];
    $description = $row['description'];
  } else {
    echo "Formation not found.";
    exit;
  }

  // Close statement
  $stmt->close();
}

// Process form data and update formation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve form data
  $name = $_POST['nom'];
  $date_f = $_POST['date_f'];
  $domain = $_POST['domain'];
  $prix = $_POST['prix'];
  $durée = $_POST['duree'];
  $description = $_POST['description'];

  // Prepare SQL statement
  $stmt = $conn->prepare("UPDATE formations SET nom = ?,  date_f = ?, domain = ?, prix = ?, duree = ?, description = ? WHERE id = ?");
  $stmt->bind_param("ssssssi", $name, $date_f,  $domain, $prix, $durée, $description, $formation_id);

  // Execute SQL statement
  if ($stmt->execute()) {
    echo "Formation updated successfully.";
  } else {
    echo "Error updating formation: " . $conn->error;
  }

  // Close statement
  $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Formation</title>
  <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
  <style>
    .form-container {
      max-width: 700px;
     margin-top: 3%;
     margin-left: 37%;
      padding: 20px;
      background: #f4f7f8;
      border: 1px solid #ccc;
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .form-container label {
      display: block;
      margin-bottom: 10px;
    }
    .form-container input,
    .form-container textarea {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      resize: vertical;
    }
    .form-container button {
      display: block;
      width: 100%;
      padding: 8px;
      margin-top: 20px;
      background: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         <?php
           include_once('includes/sidebar.php');?>
           <div class="form-container" >
  <h2>Modifier Formation</h2>
  <form method="POST" action="">
    <div>
      <label for="formation">Nom de formation:</label>
      <input type="text" id="formation" name="formation" value="<?php echo $name; ?>" required>
    </div>
    
    <div>
      <label for="date_f">Date début:</label>
      <input type="date" id="date_f" name="date_f" value="<?php echo $date_f; ?>" required>
    </div>
    <div>
      <label for="domain">Domaine:</label>
      <input type="text" id="domain" name="domain" value="<?php echo $domain; ?>" required>
    </div>
    <div>
      <label for="prix">Prix:</label>
      <input type="text" id="prix" name="prix" value="<?php echo $prix; ?>" required>
    </div>
    <div>
      <label for="duree">Durée:</label>
      <input type="text" id="duree" name="duree" value="<?php echo $durée; ?>" required>
    </div>
    <div>
      <label for="description">Description:</label>
      <textarea id="description" name="description" rows="4" required><?php echo $description; ?></textarea>
    </div>
    <button type="submit">Update</button>
  </form>
</div>
</div>
<script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>

 
