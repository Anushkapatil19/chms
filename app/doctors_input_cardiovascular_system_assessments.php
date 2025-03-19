<?php 
//http://localhost/chms/app/doctors_input_cardiovascular_system_assessments.php?case_number=202402

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

// Query to get all cardiovascular assessments related to this patient
$sql_assessments = "SELECT * FROM cardiovascular_system_assessments WHERE case_number = ?";
$stmt_assessments = $conn->prepare($sql_assessments);
$stmt_assessments->bind_param("i", $case_number);
$stmt_assessments->execute();
$result_assessments = $stmt_assessments->get_result();


?>
<?php include'includes/head.php'; ?>

<div id="layoutSidenav">
    <?php include'includes/nav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="container mt-5">
                    <div class="text-end" id="">
                        <a href="report_cardiovascular_system_assessments.php" class="btn btn-primary mt-3">Back to Patient List</a>
                    </div>
                    <h2 class="mb-4">Patient Details</h2>

                    <?php if ($patient): ?>
                    <h3>Patient Information</h3>
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Case Number:</strong> <?php echo $patient['case_number']; ?>
                        </li>
                        <li class="list-group-item"><strong>Patient Name:</strong> <?php echo $patient_name; ?></li>
                        <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo $patient['dob']; ?></li>
                        <li class="list-group-item"><strong>Contact Number:</strong>
                            <?php echo $patient['contact_number']; ?></li>
                        <li class="list-group-item"><strong>Address:</strong> <?php echo $patient['address']; ?></li>
                    </ul>

                    <h3>Cardiovascular System Assessments</h3>
                    <?php if ($result_assessments->num_rows > 0): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Breathlessness</th>
                                <th>Abdominal Distinction</th>
                                <th>Swelling</th>
                                <th>Duration of Swelling</th>
                                <th>Anomaly Scanning</th>
                                <th>Report</th>
                                <th>Respiratory Rate</th>
                                <th>Pulse Rate</th>
                                <th>Blood Pressure</th>
                                <th>SPO2</th>
                                <th>Date of Assessment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($assessment = $result_assessments->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $assessment['breathlessness']; ?></td>
                                <td><?php echo $assessment['abdominal_distinction']; ?></td>
                                <td><?php echo $assessment['swelling']; ?></td>
                                <td><?php echo $assessment['duration_of_swelling']; ?></td>
                                <td><?php echo $assessment['anomaly_scanning']; ?></td>
                                <td><?php echo $assessment['report']; ?></td>
                                <td><?php echo $assessment['respiratory_rate']; ?></td>
                                <td><?php echo $assessment['pulse_rate']; ?></td>
                                <td><?php echo $assessment['blood_pressure']; ?></td>
                                <td><?php echo $assessment['spO2']; ?></td>
                                <td><?php echo $assessment['created_at']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p>No assessments found for this patient.</p>
                    <?php endif; ?>

                    <h3 class="mt-5">Doctor's Notes</h3>
                    <form method="POST" action="dbhelper/save_doctors_input_cardiovascular_system_assessments.php">
                        <div class="mb-3">
                            <label for="prescription" class="form-label">Prescription</label>
                            <textarea name="prescription" id="prescription" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea name="comments" id="comments" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Notes</button>
                    </form>

                    <?php else: ?>
                    <p>No patient found with the given Case Number.</p>
                    <?php endif; ?>

                    
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
