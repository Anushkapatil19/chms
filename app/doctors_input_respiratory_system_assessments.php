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

// Query to get all respiratory system assessments related to this patient
$sql_assessments = "SELECT * FROM respiratory_system_assessments WHERE case_number = ?";
$stmt_assessments = $conn->prepare($sql_assessments);
$stmt_assessments->bind_param("i", $case_number);
$stmt_assessments->execute();
$result_assessments = $stmt_assessments->get_result();

// Handling form submission for doctor's prescription and comments
session_start();
// $user_id = $_SESSION['user_id'];  // Assuming the doctor is logged in and their user ID is stored in the session
$user_id = 1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prescription = $_POST['prescription'];
    $comments = $_POST['comments'];

    // Insert doctor's notes into the database including the user_id
    $sql_insert = "INSERT INTO doctor_notes (case_number, user_id, prescription, comments) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("iiss", $case_number, $user_id, $prescription, $comments);
    
    if ($stmt_insert->execute()) {
        echo "<script>alert('Doctor\'s notes added successfully.');</script>";
    } else {
        echo "<script>alert('Failed to add doctor\'s notes.');</script>";
    }
}

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
                    <div class="text-end">
                        <a href="report_respiratory_system_assessments.php" class="btn btn-primary mt-3">Back to Patient
                            List</a>
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

                    <h3>Respiratory System Assessments</h3>
                    <?php if ($result_assessments->num_rows > 0): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Age</th>
                                <th>Respiratory Rate</th>
                                <th>Heart Rate</th>
                                <th>Consciousness State</th>
                                <th>Taking Feed</th>
                                <th>Irritable</th>
                                <th>Duration of Illness</th>
                                <th>Symptoms Trend</th>
                                <th>Similar Episode</th>
                                <th>Condition in Siblings</th>
                                <th>Previous Medicine</th>
                                <th>Date of Assessment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($assessment = $result_assessments->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $assessment['age']; ?></td>
                                <td><?php echo $assessment['respiratory_rate']; ?></td>
                                <td><?php echo $assessment['heart_rate']; ?></td>
                                <td><?php echo $assessment['child_state']; ?></td>
                                <td><?php echo $assessment['taking_feed']; ?></td>
                                <td><?php echo $assessment['irritable']; ?></td>
                                <td><?php echo $assessment['duration_of_illness']; ?></td>
                                <td><?php echo $assessment['symptom_trend']; ?></td>
                                <td><?php echo $assessment['similar_episode']; ?></td>
                                <td><?php echo $assessment['condition_in_siblings']; ?></td>
                                <td><?php echo $assessment['previous_medicine']; ?></td>
                                <td><?php echo $assessment['created_at']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p>No assessments found for this patient.</p>
                    <?php endif; ?>

                    <h3 class="mt-5">Doctor's Notes</h3>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="prescription" class="form-label">Prescription</label>
                            <textarea name="prescription" id="prescription" class="form-control" rows="4"
                                required></textarea>
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