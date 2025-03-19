<?php
include 'db_con.php';

$errmsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $case_number = $_POST['case_number'];
    $age = $_POST['age'];
    $respiratory_rate = $_POST['respiratory_rate'];
    $heart_rate = $_POST['heart_rate'];
    $child_state = $_POST['child_state'];
    $taking_feed = $_POST['taking_feed'];
    $irritable = $_POST['irritable'];
    $duration_of_illness = $_POST['duration_of_illness'];
    $symptom_trend = $_POST['symptom_trend'];
    $similar_episode = $_POST['similar_episode'];
    $condition_in_siblings = $_POST['condition_in_siblings'];
    $previous_medicine = $_POST['previous_medicine'];
    $medicine_names = $_POST['medicine_names'];

    // Check if case_number exists in the patients table
    $stmt = $conn->prepare("SELECT case_number FROM patients WHERE case_number = ?");
    $stmt->bind_param("i", $case_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Case number exists, proceed with insert
        $stmt = $conn->prepare("INSERT INTO respiratory_system_assessments 
        ( case_number, age, respiratory_rate, heart_rate, child_state, taking_feed, irritable, 
        duration_of_illness, symptom_trend, similar_episode, condition_in_siblings, previous_medicine, 
        medicine_names) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("iiissssssssss", $case_number, $age, $respiratory_rate, $heart_rate, $child_state, $taking_feed, $irritable, 
        $duration_of_illness, $symptom_trend, $similar_episode, $condition_in_siblings, $previous_medicine, $medicine_names);

        if ($stmt->execute()) {
            $errmsg .= "<div class='alert alert-success'>Assessment submitted successfully with Case Number: $case_number</div>";
            header('Location: ../respiratory_system_assessments.php?success='.$errmsg);
        } else {
            $errmsg .= "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            header('Location: ../respiratory_system_assessments.php?error='.$errmsg);
        }

        $stmt->close();
    } else {
        // Case number does not exist
        $errmsg .= "<div class='alert alert-danger'>Error: Case Number $case_number does not exist in the patients table.</div>";
        header('Location: ../respiratory_system_assessments.php?error='.$errmsg);
    }
    $conn->close();
}else{
    $errmsg .= "<div class='alert alert-danger'>Error: Please fill all the required fields. </div>";
    header('Location: ../respiratory_system_assessments.php?error='.$errmsg);
}




exit();
