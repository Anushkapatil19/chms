<?php include'includes/head.php';
include'dbhelper/db_con.php'; ?>

<div id="layoutSidenav">
    <?php include'includes/nav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Perabdominal Assessments</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard/Perabdominal Assessments</li>
                </ol>
                <div class="container mt-5">
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
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Enter Patient Information
                            </div>
                            <div class="card-body">
                                <h2>Perabdominal Assessments</h2>
                                <form method="POST" action="dbhelper/save_perabdominal_assessments.php">

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
                                        <label for="consciousness_state" class="form-label">Consciousness State</label>
                                        <select class="form-select" id="consciousness_state" name="consciousness_state"
                                            required>
                                            <option value="Conscious">Conscious</option>
                                            <option value="Oriented">Oriented</option>
                                            <option value="Disoriented">Disoriented</option>
                                            <option value="Completely unconscious">Completely unconscious</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="complaint" class="form-label">What is the Complaint?</label>
                                        <textarea class="form-control" id="complaint" name="complaint" rows="3"
                                            required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="complaint_duration" class="form-label">Duration of the
                                            Complaint</label>
                                        <input type="text" class="form-control" id="complaint_duration"
                                            name="complaint_duration">
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
                                        <label for="similar_in_siblings" class="form-label">Similar Condition in
                                            Siblings?</label>
                                        <select class="form-select" id="similar_in_siblings" name="similar_in_siblings"
                                            required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="past_urine_stool" class="form-label">Has the Child Passed Urine or
                                            Stool in the Past Hours?</label>
                                        <select class="form-select" id="past_urine_stool" name="past_urine_stool"
                                            required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="urine_stool_frequency" class="form-label">Frequency of Urine or
                                            Stool</label>
                                        <input type="text" class="form-control" id="urine_stool_frequency"
                                            name="urine_stool_frequency">
                                    </div>
                                    <div class="mb-3">
                                        <label for="abdominal_swelling" class="form-label">Is There Any Abdominal
                                            Swelling?</label>
                                        <select class="form-select" id="abdominal_swelling" name="abdominal_swelling"
                                            required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="abdominal_distention" class="form-label">Is There Any Abdominal
                                            Distention?</label>
                                        <select class="form-select" id="abdominal_distention"
                                            name="abdominal_distention" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="abdominal_girth" class="form-label">Abdominal Girth at the Level of
                                            Umbilicus</label>
                                        <input type="text" class="form-control" id="abdominal_girth"
                                            name="abdominal_girth">
                                    </div>
                                    <div class="mb-3">
                                        <label for="vomiting" class="form-label">Vomiting?</label>
                                        <select class="form-select" id="vomiting" name="vomiting" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="vomiting_frequency" class="form-label">Frequency of Vomiting</label>
                                        <input type="text" class="form-control" id="vomiting_frequency"
                                            name="vomiting_frequency">
                                    </div>
                                    <div class="mb-3">
                                        <label for="vomiting_type" class="form-label">Type of Vomiting</label>
                                        <select class="form-select" id="vomiting_type" name="vomiting_type">
                                            <option value="Projectile">Projectile</option>
                                            <option value="Non-projectile">Non-projectile</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="vomiting_color" class="form-label">Color of Vomit</label>
                                        <input type="text" class="form-control" id="vomiting_color"
                                            name="vomiting_color">
                                    </div>
                                    <div class="mb-3">
                                        <label for="loose_motion" class="form-label">Loose Motion?</label>
                                        <select class="form-select" id="loose_motion" name="loose_motion" required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="loose_motion_blood" class="form-label">Blood in Loose
                                            Motion?</label>
                                        <select class="form-select" id="loose_motion_blood" name="loose_motion_blood">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="loose_motion_color" class="form-label">Color of Loose Motion</label>
                                        <input type="text" class="form-control" id="loose_motion_color"
                                            name="loose_motion_color">
                                    </div>
                                    <div class="mb-3">
                                        <label for="pulse_rate" class="form-label">Pulse Rate</label>
                                        <input type="number" class="form-control" id="pulse_rate" name="pulse_rate"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                                        <input type="number" class="form-control" id="respiratory_rate"
                                            name="respiratory_rate" required>
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