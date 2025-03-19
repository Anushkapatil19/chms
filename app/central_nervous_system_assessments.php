<?php include'includes/head.php'; 
include'dbhelper/db_con.php'; ?>

<div id="layoutSidenav">
    <?php include'includes/nav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Central Nervous System Assessment</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
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
                            <div class="card-header bg-danger text-light">
                                <i class="fas fa-chart-area me-1"></i>
                                Enter Patient Information
                            </div>
                            <div class="card-body">
                                <h2>Central Nervous System Assessment</h2>
                                <form method="POST" action="dbhelper/save_central_nervous_system_assessments.php">
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
                                    <div class="mb-3">
                                        <label for="duration_of_illness" class="form-label">Duration of the
                                            Illness</label>
                                        <input type="text" class="form-control" id="duration_of_illness"
                                            name="duration_of_illness" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="condition_in_family" class="form-label">Condition in Siblings or
                                            Family?</label>
                                        <select class="form-select" id="condition_in_family" name="condition_in_family"
                                            required>
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
                                    <div class="mb-3">
                                        <label for="food_intake_past_hours" class="form-label">What did the Patient Eat
                                            in Past Hours?</label>
                                        <textarea class="form-control" id="food_intake_past_hours"
                                            name="food_intake_past_hours" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="intoxication_duration" class="form-label">Intoxication
                                            Duration</label>
                                        <input type="text" class="form-control" id="intoxication_duration"
                                            name="intoxication_duration">
                                    </div>
                                    <div class="mb-3">
                                        <label for="abnormal_movement" class="form-label">What Kind of Abnormal
                                            Movement?</label>
                                        <textarea class="form-control" id="abnormal_movement" name="abnormal_movement"
                                            rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="movement_duration" class="form-label">Duration of Those
                                            Movements</label>
                                        <input type="text" class="form-control" id="movement_duration"
                                            name="movement_duration">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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