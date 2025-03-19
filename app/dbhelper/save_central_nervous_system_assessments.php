<?php

$errmsg = "";
$errmsg = "<div class='alert alert-danger'>Error: This page is under development</div>";
header('Location: ../central_nervous_system_assessments.php?success='.$errmsg);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to database    
    include 'db_con.php';
    // Collect form data
    $case_number = $_POST['case_number'];
    $duration_of_illness = $_POST['duration_of_illness'];
    $condition_in_family = $_POST['condition_in_family'];
    $previous_medicine = $_POST['previous_medicine'];
    $medicine_names = $_POST['medicine_names'];
    $food_intake_past_hours = $_POST['food_intake_past_hours'];
    $intoxication_duration = $_POST['intoxication_duration'];
    $abnormal_movement = $_POST['abnormal_movement'];
    $movement_duration = $_POST['movement_duration'];

    // Check if case_number exists in the patients table
    $stmt = $conn->prepare("SELECT case_number FROM patients WHERE case_number = ?");
    $stmt->bind_param("i", $case_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Case number exists, proceed with insert
        $stmt = $conn->prepare("INSERT INTO central_nervous_system_assessments 
        (case_number, duration_of_illness, condition_in_family, previous_medicine, medicine_names, food_intake_past_hours, intoxication_duration, abnormal_movement, movement_duration) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("issssssss", $case_number, $duration_of_illness, $condition_in_family, $previous_medicine, $medicine_names, $food_intake_past_hours, $intoxication_duration, $abnormal_movement, $movement_duration);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>CNS assessment submitted successfully with Case Number: $case_number!</div>";
            header('Location: ../central_nervous_system_assessments.php?success='.$errmsg);
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            header('Location: ../central_nervous_system_assessments.php?success='.$errmsg);
        }

        $stmt->close();
    } else {
        // Case number does not exist
        echo "<div class='alert alert-danger'>Error: Case Number $case_number does not exist in the patients table.</div>";
        header('Location: ../central_nervous_system_assessments.php?success='.$errmsg);
    }
    $conn->close();
}

