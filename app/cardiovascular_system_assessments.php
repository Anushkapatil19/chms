<?php include'includes/head.php'; 
include'dbhelper/db_con.php'; ?>

<div id="layoutSidenav">
    <?php include'includes/nav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Cardiovascular System Assessments</h1>
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
                                <h2>Cardiovascular System Assessments</h2>
                                <form method="POST" action="dbhelper/save_cardiovascular_system_assessments.php">
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
                                        <label for="breathlessness" class="form-label">Is there breathlessness?</label>
                                        <select class="form-select" id="breathlessness" name="breathlessness" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="abdominal_distension" class="form-label">Is there abdominal
                                            distension?</label>
                                        <select class="form-select" id="abdominal_distension"
                                            name="abdominal_distension" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="swelling" class="form-label">Is there swelling on legs, hands, or
                                            body?</label>
                                        <select class="form-select" id="swelling" name="swelling" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="swelling_duration" class="form-label">Duration of Swelling (if
                                            applicable)</label>
                                        <input type="text" class="form-control" id="swelling_duration"
                                            name="swelling_duration">
                                    </div>
                                    <div class="mb-3">
                                        <label for="anomaly_scanning" class="form-label">Anomaly Scanning During
                                            Delivery?</label>
                                        <select class="form-select" id="anomaly_scanning" name="anomaly_scanning"
                                            required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="anomaly_report" class="form-label">Report (if applicable)</label>
                                        <textarea class="form-control" id="anomaly_report" name="anomaly_report"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                                        <input type="number" class="form-control" id="respiratory_rate"
                                            name="respiratory_rate" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pulse_rate" class="form-label">Pulse Rate</label>
                                        <input type="number" class="form-control" id="pulse_rate" name="pulse_rate"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="blood_pressure" class="form-label">Blood Pressure (BP)</label>
                                        <input type="text" class="form-control" id="blood_pressure"
                                            name="blood_pressure" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="spO2" class="form-label">SPO2</label>
                                        <input type="number" class="form-control" id="spO2" name="spO2" required>
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