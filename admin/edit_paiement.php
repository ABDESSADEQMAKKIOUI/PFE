<!DOCTYPE html>
<html>
<head>
	<title>Modify Payment</title>
     <!-- Font Awesome -->
     <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <style>
		body {
			font-family: Arial, sans-serif;
		}
		h1 {
			text-align: center;
            padding-top: 3%;
    
		}
		form {
			width: 400px;
			margin: auto;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
		select, input[type="text"], input[type="date"], textarea {
			width: 100%;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-bottom: 10px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
      session_start();
      $conn = mysqli_connect("localhost", "root", "", "test");
      if (strlen($_SESSION['name']) == 0) {
          header('location:authentic.php');
      } else {
         include_once('includes/sidebar.php');
         echo"<div class='content-wrapper'>";
	    echo"<div ><h1 >Modifier Paiement</h1></div >";
	
		// Create connection
		
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Get payment ID from URL parameter
			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				// Retrieve payment information from database
				$stmt = $conn->prepare("SELECT * FROM paiement WHERE id = ?");
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$result = $stmt->get_result();

				if ($result->num_rows == 1) {
					$row = $result->fetch_assoc();
	?>
	<form method="POST" action="update_payment.php">
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
		<label>Student:</label>
		<select name="student">
			<?php
				// Retrieve list of students from database
				$stmt = $conn->prepare("SELECT * FROM etudiant");
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row_student = $result->fetch_assoc()) {
					$selected = $row_student['id'] == $row['etudiant_id'] ? "selected" : "";
					echo "<option value=\"{$row_student['first_name']}\" $selected>{$row_student['first_name']}</option>";
				}
			?>
		</select>
		<br><br>
		<label>Formation:</label>
		<select name="formation_p">
			<?php
				// Retrieve list of formations from database
				$stmt = $conn->prepare("SELECT * FROM formations");
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row_formation = $result->fetch_assoc()) {
					$selected = $row_formation['id'] == $row['formation_id'] ? "selected" : "";
					echo "<option value=\"{$row_formation['nom']}\" $selected>{$row_formation['nom']}</option>";
				}
			?>
		</select>
		<br><br>
		<label>Price:</label>
		<input type="text" name="prix" value="<?php echo $row['prix']; ?>">
		<br><br>
		<label>Date:</label>
		<input type="date" name="date_p" value="<?php echo $row['date_p']; ?>">
		<br><br>
		<label>Remark:</label>
		<textarea name="remark"><?php echo $row['remark']; ?></textarea>
		<br><br>
		<input type="submit" value="Save">
	</form>
	<?php
				} else {
					echo "Payment not found in the database.";
				}
			} else {
				echo "Payment ID not provided.";
			}

			// Close connection
			mysqli_close($conn);
		}
	?>
</div>
</div>
<script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
</body>
</html>
