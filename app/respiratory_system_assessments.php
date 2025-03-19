<?php 
include'includes/head.php'; 
include'dbhelper/db_con.php';
?>

<div id="layoutSidenav">
    <?php include'includes/nav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Respiratory System Assessments</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard/new case</li>
                </ol>
                <div class="col-sm-8 mt-5">
                    <?php 
                        // Check if 'error' or 'success' is present in the URL
                        if (isset($_GET['error'])) {
                            $error_message = $_GET['error'];
                            echo $error_message;
                        } elseif (isset($_GET['success'])) {
                            $success_message = $_GET['success'];
                            echo $success_message;
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-light">
                                <i class="fas fa-chart-area me-1"></i>
                                Enter Patient Information
                            </div>
                            <div class="card-body">
                                <h2>Respiratory System Assessments</h2>
                                <form method="POST" action="dbhelper/save_respiratory_system_assessments.php">
                                    <div class="mb-3">
                                        <label for="case_number" class="form-label">Case Number</label>
                                        <select class="form-select" id="case_number" name="case_number" required>
                                            <?php
                    // Fetch case numbers from the patients table
                    $stmt = $conn->prepare("SELECT case_number FROM patients");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['case_number']."'>".$row['case_number']."</option>";
                    }
                    $stmt->close();
                    ?>
                                        </select>
                                    </div>
                                    <!-- Other form fields (age, respiratory rate, etc.) go here -->
                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                                        <input type="number" class="form-control" id="respiratory_rate"
                                            name="respiratory_rate" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="heart_rate" class="form-label">Heart Rate</label>
                                        <input type="number" class="form-control" id="heart_rate" name="heart_rate"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="child_state" class="form-label">Child State</label>
                                        <select class="form-select" id="child_state" name="child_state" required>
                                            <option value="Conscious">Conscious</option>
                                            <option value="Subconscious">Subconscious</option>
                                            <option value="Alert">Alert</option>
                                            <option value="Disorient">Disorient</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="taking_feed" class="form-label">Taking Feed</label>
                                        <select class="form-select" id="taking_feed" name="taking_feed" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="irritable" class="form-label">Is the Child Irritable?</label>
                                        <select class="form-select" id="irritable" name="irritable" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration_of_illness" class="form-label">Duration of the
                                            Illness</label>
                                        <input type="text" class="form-control" id="duration_of_illness"
                                            name="duration_of_illness">
                                    </div>
                                    <div class="mb-3">
                                        <label for="symptom_trend" class="form-label">Symptom Trend</label>
                                        <select class="form-select" id="symptom_trend" name="symptom_trend" required>
                                            <option value="Increasing">Increasing</option>
                                            <option value="Decreasing">Decreasing</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="similar_episode" class="form-label">Similar Episode in the
                                            Past?</label>
                                        <select class="form-select" id="similar_episode" name="similar_episode"
                                            required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="condition_in_siblings" class="form-label">Condition Available in
                                            Siblings?</label>
                                        <select class="form-select" id="condition_in_siblings"
                                            name="condition_in_siblings" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="previous_medicine" class="form-label">Previous Medicine</label>
                                        <textarea class="form-control" id="previous_medicine" name="previous_medicine"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="medicine_names" class="form-label">Names of the Medicine</label>
                                        <textarea class="form-control" id="medicine_names" name="medicine_names"
                                            rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include('includes/footer.php');?>
    </div>
</div>
<?php include('includes/footer_link.php');?>