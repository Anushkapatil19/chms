<?php 

session_start();
include 'db_con.php';

// Handling form submission for doctor's prescription and comments
// $doctor_id = $_SESSION['doctor_id'];
$doctor_id = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prescription = $_POST['prescription'];
    $comments = $_POST['comments'];

    die($prescription);
    // Insert doctor's notes into the database including the doctor_id
    $sql_insert = "INSERT INTO doctor_notes (case_number, doctor_id, prescription, comments) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("iiss", $case_number, $doctor_id, $prescription, $comments);
    
    if ($stmt_insert->execute()) {
        echo "<script>alert('Doctor\'s notes added successfully.');</script>";
    } else {
        echo "<script>alert('Failed to add doctor\'s notes.');</script>";
    }
}