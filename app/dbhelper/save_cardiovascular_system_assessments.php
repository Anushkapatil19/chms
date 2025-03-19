<?php
include 'db_con.php';

$errmsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $case_number = $_POST['case_number'];
    $breathlessness = $_POST['breathlessness'];
    $abdominal_distension = $_POST['abdominal_distension'];
    $swelling = $_POST['swelling'];
    $swelling_duration = $_POST['swelling_duration'];
    $anomaly_scanning = $_POST['anomaly_scanning'];
    $anomaly_report = $_POST['anomaly_report'];
    $respiratory_rate = $_POST['respiratory_rate'];
    $pulse_rate = $_POST['pulse_rate'];
    $blood_pressure = $_POST['blood_pressure'];
    $spO2 = $_POST['spO2'];

    // Check if case_number exists in the patients table
    $stmt = $conn->prepare("SELECT case_number FROM patients WHERE case_number = ?");
    $stmt->bind_param("i", $case_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //if ask then check for case_number is exists in the cardiovascular_system_assessments table
        // Case number exists, proceed with insert
        $stmt = $conn->prepare("INSERT INTO cardiovascular_system_assessments 
        (case_number, breathlessness, abdominal_distension, swelling, swelling_duration, anomaly_scanning, anomaly_report, respiratory_rate, pulse_rate, blood_pressure, spO2) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("issssssssis", $case_number, $breathlessness, $abdominal_distension, $swelling, $swelling_duration, $anomaly_scanning, $anomaly_report, $respiratory_rate, $pulse_rate, $blood_pressure, $spO2);

        if ($stmt->execute()) {
            $errmsg .= "<div class='alert alert-success'>Cardiovascular assessment submitted successfully with Case Number: $case_number!</div>";
            header('Location: ../cardiovascular_system_assessments.php?success='.$errmsg);
        } else {
            $errmsg .= "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            header('Location: ../cardiovascular_system_assessments.php?error='.$errmsg);
        }

        $stmt->close();
        $conn->close();
    } else {
        // Case number does not exist
        $errmsg .= "<div class='alert alert-danger'>Error: Case Number $case_number does not exist in the patients table.</div>";
        header('Location:../cardiovascular_system_assessments.php?error='.$errmsg);
    }
}else{
    $errmsg .= "<div class='alert alert-danger'>Error: Please fill all the required fields. </div>";
    header('Location: ../respiratory_system_assessments.php?error='.$errmsg);
}

exit();


