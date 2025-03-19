<?php
include 'db_con.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Storing plain text password
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    // Check if username already exists
    $sql_check_username = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check_username);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "Username already taken!";
    } else {
        // Insert the new user into the database with plain password
        $sql_insert = "INSERT INTO users (full_name, username, password, type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("ssss", $full_name, $username, $password, $type);

        if ($stmt->execute()) {
            echo "User registered successfully!";
            header('Location: ../user_registration.php?msg=User registered successfully!'); // Redirect to login page after registration
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statements and connection
    $stmt_check->close();
    $stmt->close();
    $conn->close();
}
?>
