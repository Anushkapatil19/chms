<?php
include 'db_con.php';

$errmsg = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // File upload handling
    $target_dir = "../reports/";
    $report_file = isset($_FILES['report']['name']) ? basename($_FILES['report']['name']) : null;
    $newFileName = uniqid() . "_" . $report_file;
    $target_file = $report_file ? $target_dir . $newFileName : null;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if a file is uploaded
    if (!empty($_FILES['report']['tmp_name'])) {
        // Check if the file is a valid format (you can adjust the allowed types)
        $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'png'];
        if (!in_array($fileType, $allowedTypes)) {
            $errmsg .= "<div class='alert alert-danger'>Only PDF, DOC, DOCX, JPG, and PNG files are allowed!</div>";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES["report"]["size"] > 5000000) {
            $errmsg .= "<div class='alert alert-danger'>File is too large. Maximum size is 5MB.</div>";
            $uploadOk = 0;
        }

        // Try to upload the file if no errors
        if ($uploadOk && !move_uploaded_file($_FILES["report"]["tmp_name"], $target_file)) {
            $errmsg .= "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
        }
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errmsg .= "<div class='alert alert-danger'>Invalid email format!</div>";
    }

    // Validate contact number format
    if (!preg_match("/^[0-9]{10}$/", $contact_number)) {
        $errmsg .= "<div class='alert alert-danger'>Invalid contact number format!</div>";
    }

    // Additional validation checks
    if (empty($first_name) || empty($last_name)) {
        $errmsg .= "<div class='alert alert-danger'>First name and last name are required!</div>";
    }
    if (empty($gender)) {
        $errmsg .= "<div class='alert alert-danger'>Please select a gender!</div>";
    }
    if (empty($dob)) {
        $errmsg .= "<div class='alert alert-danger'>Date of birth is required!</div>";
    }
    if (empty($contact_number)) {
        $errmsg .= "<div class='alert alert-danger'>Contact number is required!</div>";
    }
    if (empty($address)) {
        $errmsg .= "<div class='alert alert-danger'>Address is required!</div>";
    }

    // If there are errors, redirect with an error message
    if (!empty($errmsg)) {
        header('Location: ../case_registration.php?error=' . $errmsg);
        exit();
    } else {
        // Fetch case number and increment it
        $stmt = $conn->prepare("SELECT MAX(id) AS max_case_number FROM patients");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $case_number = ($row['max_case_number'] !== null) ? date('Y') . str_pad($row['max_case_number'] + 1, 4, '0', STR_PAD_LEFT) : date('Y') . '0001';

        // Sanitize inputs
        $first_name = mysqli_real_escape_string($conn, $first_name);
        $last_name = mysqli_real_escape_string($conn, $last_name);
        $gender = mysqli_real_escape_string($conn, $gender);
        $dob = mysqli_real_escape_string($conn, $dob);
        $contact_number = mysqli_real_escape_string($conn, $contact_number);
        $email = mysqli_real_escape_string($conn, $email);
        $address = mysqli_real_escape_string($conn, $address);

        // Insert patient into the database
        $dob = date('Y-m-d', strtotime($dob));

        // Adjust query to include the report file path if uploaded
        if ($report_file && $uploadOk) {
            $stmt = $conn->prepare("INSERT INTO patients (case_number, first_name, last_name, gender, dob, contact_number, email, address, report) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssssss", $case_number, $first_name, $last_name, $gender, $dob, $contact_number, $email, $address, $newFileName);
        } else {
            $stmt = $conn->prepare("INSERT INTO patients (case_number, first_name, last_name, gender, dob, contact_number, email, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssss", $case_number, $first_name, $last_name, $gender, $dob, $contact_number, $email, $address);
        }

        if ($stmt->execute()) {
            $errmsg .= "<div class='alert alert-success'>Patient registered successfully! with Case No.$case_number</div>";
            header('Location: ../case_registration.php?success=' . $errmsg);
        } else {
            $errmsg .= "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            header('Location: ../case_registration.php?error=' . $errmsg);
        }

        $stmt->close();
    }
    $conn->close();
} else {
    header('Location: ../case_registration.php?error=Please fill all the fields.');
}

exit();
