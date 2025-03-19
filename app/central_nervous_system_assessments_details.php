<?php 

include 'dbhelper/db_con.php';

// Get case_number from URL
$case_number = isset($_GET['case_number']) ? $_GET['case_number'] : 0;

// Query to get patient details
$sql_patient = "SELECT * FROM patients WHERE case_number = ?";
$stmt = $conn->prepare($sql_patient);
$stmt->bind_param("i", $case_number);
$stmt->execute();
$result_patient = $stmt->get_result();
$patient = $result_patient->fetch_assoc();

$patient_name = $patient['first_name'].' '.$patient['last_name'];

// Query to get all CNS assessments related to this patient
$tableName = "central_nervous_system_assessments";
$sql_assessments = "SELECT * FROM $tableName WHERE case_number = ?";
$stmt_assessments = $conn->prepare($sql_assessments);
$stmt_assessments->bind_param("i", $case_number);
$stmt_assessments->execute();
$result_assessments = $stmt_assessments->get_result();

// Query to fetch doctor notes
$sql_doctor_notes = "SELECT dn.prescription, dn.comments, dn.created_at, u.full_name
                    FROM doctor_notes dn
                    JOIN users u ON dn.doctor_id = u.id
                    WHERE dn.case_number = ? AND dn.case_type = '$tableName'";
$stmt_notes = $conn->prepare($sql_doctor_notes);
$stmt_notes->bind_param("i", $case_number);
$stmt_notes->execute();
$result_notes = $stmt_notes->get_result();

?>
<?php include'includes/head.php'; ?>

<div id="layoutSidenav">
    <?php include'includes/nav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="container mt-5">
                    <h2 class="mb-4">Patient Details</h2>

                    <?php if ($patient): ?>
                    <h3>Patient Information</h3>
                    <div class="row">
                        <div class="col-sm-8">
                            <ul class="list-group mb-4">
                                <li class="list-group-item"><strong>Case Number:</strong>
                                    <?php echo $patient['case_number']; ?>
                                </li>
                                <li class="list-group-item"><strong>Patient Name:</strong> <?php echo $patient_name; ?>
                                </li>
                                <li class="list-group-item"><strong>Date of Birth:</strong>
                                    <?php echo $patient['dob']; ?></li>
                                <li class="list-group-item"><strong>Contact Number:</strong>
                                    <?php echo $patient['contact_number']; ?></li>
                                <li class="list-group-item"><strong>Address:</strong> <?php echo $patient['address']; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-4 text-end">
                            <input type="hidden" id="qrText" value="<?php echo $patient['case_number']; ?>"
                                placeholder="Enter text or URL">
                            <div id="qrcode"></div>
                        </div>
                    </div>

                    <h3>CNS Assessments</h3>
                    <?php if ($result_assessments->num_rows > 0): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Duration of Illness</th>
                                <th>Condition in Family</th>
                                <th>Previous Medicine</th>
                                <th>Medicine Names</th>
                                <th>Food Intake (Past Hours)</th>
                                <th>Intoxication Duration</th>
                                <th>Abnormal Movement</th>
                                <th>Movement Duration</th>
                                <th>Date of Assessment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($assessment = $result_assessments->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $assessment['duration_of_illness']; ?></td>
                                <td><?php echo $assessment['condition_in_family']; ?></td>
                                <td><?php echo $assessment['previous_medicine']; ?></td>
                                <td><?php echo $assessment['medicine_names']; ?></td>
                                <td><?php echo $assessment['food_intake_past_hours']; ?></td>
                                <td><?php echo $assessment['intoxication_duration']; ?></td>
                                <td><?php echo $assessment['abnormal_movement']; ?></td>
                                <td><?php echo $assessment['movement_duration']; ?></td>
                                <td><?php echo $assessment['created_at']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p>No assessments found for this patient.</p>
                    <?php endif; ?>

                     <!-- Display Doctor Notes -->
                     <h3 class="mt-5">Doctor's Notes</h3>
                    <?php if ($result_notes->num_rows > 0): ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Prescription</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($note = $result_notes->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $note['full_name']; ?></td>
                                    <td><?php echo $note['prescription']; ?></td>
                                    <td><?php echo $note['comments']; ?></td>
                                    <td><?php echo $note['created_at']; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-danger">No doctor's notes available for this patient.</p>
                    <?php endif; ?>

                    <?php else: ?>
                    <p>No patient found with the given Case Number.</p>
                    <?php endif; ?>
                        
                    <a href="report_central_nervous_system_assessments.php" class="btn btn-secondary mt-3">Back to Patient
                        List</a>
                </div>

                <?php
                    $conn->close();
                    ?>
            </div>
        </main>
        <?php include('includes/footer.php');?>
    </div>
</div>
<?php include('includes/footer_link.php');?>
