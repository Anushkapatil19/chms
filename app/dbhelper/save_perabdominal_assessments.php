<?php
include 'db_con.php';

$errmsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $case_number = $_POST['case_number'];
    $duration_of_illness = $_POST['duration_of_illness'];
    $condition_in_family = $_POST['condition_in_family'];
    $previous_medicine = $_POST['previous_medicine'];
    $medicine_names = $_POST['medicine_names'];
    $consciousness_state = $_POST['consciousness_state'];
    $complaint = $_POST['complaint'];
    $complaint_duration = $_POST['complaint_duration'];
    $similar_episode = $_POST['similar_episode'];
    $similar_in_siblings = $_POST['similar_in_siblings'];
    $past_urine_stool = $_POST['past_urine_stool'];
    $urine_stool_frequency = $_POST['urine_stool_frequency'];
    $abdominal_swelling = $_POST['abdominal_swelling'];
    $abdominal_distention = $_POST['abdominal_distention'];
    $abdominal_girth = $_POST['abdominal_girth'];
    $vomiting = $_POST['vomiting'];
    $vomiting_frequency = $_POST['vomiting_frequency'];
    $vomiting_type = $_POST['vomiting_type'];
    $vomiting_color = $_POST['vomiting_color'];
    $loose_motion = $_POST['loose_motion'];
    $loose_motion_blood = $_POST['loose_motion_blood'];
    $loose_motion_color = $_POST['loose_motion_color'];
    $pulse_rate = $_POST['pulse_rate'];
    $respiratory_rate = $_POST['respiratory_rate'];
    $spO2 = $_POST['spO2'];

    // Check if case_number exists in the patients table
    $stmt = $conn->prepare("SELECT case_number FROM patients WHERE case_number = ?");
    $stmt->bind_param("i", $case_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Case number exists, proceed with insert
        $stmt = $conn->prepare("INSERT INTO perabdominal_assessments 
        (case_number, duration_of_illness, condition_in_family, previous_medicine, medicine_names, consciousness_state, complaint, complaint_duration, 
        similar_episode, similar_in_siblings, past_urine_stool, urine_stool_frequency, abdominal_swelling, abdominal_distention, abdominal_girth, 
        vomiting, vomiting_frequency, vomiting_type, vomiting_color, loose_motion, loose_motion_blood, loose_motion_color, pulse_rate, 
        respiratory_rate, spO2) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("issssssssssissssssssssiii", 
            $case_number, $duration_of_illness, $condition_in_family, $previous_medicine, $medicine_names, $consciousness_state, 
            $complaint, $complaint_duration, $similar_episode, $similar_in_siblings, $past_urine_stool, $urine_stool_frequency, 
            $abdominal_swelling, $abdominal_distention, $abdominal_girth, $vomiting, $vomiting_frequency, $vomiting_type, 
            $vomiting_color, $loose_motion, $loose_motion_blood, $loose_motion_color, $pulse_rate, $respiratory_rate, $spO2);

        if ($stmt->execute()) {
            $errmsg .= "<div class='alert alert-success'>Perabdominal assessment submitted successfully with Case Number: $case_number!</div>";
            header('Location:../perabdominal_assessments.php?success='.$errmsg);
        } else {
            $errmsg .= "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            header('Location:../perabdominal_assessments.php?error='.$errmsg);
        }

        $stmt->close();
    } else {
        // Case number does not exist
        $errmsg .= "<div class='alert alert-danger'>Error: Case Number $case_number does not exist in the patients table.</div>";
        header('Location:../perabdominal_assessments.php?error='.$errmsg);
    }
    $conn->close();
}else{
    $errmsg.= "<div class='alert alert-danger'>Error: Please fill all the required fields. </div>";
    header('Location:../perabdominal_assessments.php?error='.$errmsg);
}


