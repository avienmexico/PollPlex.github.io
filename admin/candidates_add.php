<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $platform = $_POST['platform'];
    $filename = $_FILES['photo']['name'];

    // Perform input validation and sanitation as needed

    if (!empty($filename)) {
		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);
	}

    // Use a prepared statement to prevent SQL injection
    $sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, platform) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $position, $firstname, $lastname, $filename, $platform);

    if($stmt->execute()){
        $_SESSION['success'] = 'Candidate added successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
}
else{
    $_SESSION['error'] = 'Fill up the add form first';
}

header('location: candidates.php');
?>
