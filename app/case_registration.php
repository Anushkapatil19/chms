<?php include'includes/head.php'; ?>

<div id="layoutSidenav">
    <?php include'includes/nav.php'; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">New Case Registration</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard/new case</li>
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
                                <h2>Patient Registration</h2>
                                <form method="POST" action="dbhelper/save_patient.php" enctype="multipart/form-data">

                                    <!-- <div class="mb-3">
                                        <label for="caseNumber">Case Number</label>
                                        <input type="text" class="form-control" id="caseNumber"
                                            placeholder="Enter case number">
                                        <div class="invalid-feedback">Case number is required.</div>
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Weight" class="form-label">Weight</label>
                                        <input type="text" class="form-control" id="weight" name="weight"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="height" class="form-label">Height</label>
                                        <input type="text" class="form-control" id="height" name="height"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact_number" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_number"
                                            name="contact_number" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3"
                                            required></textarea>
                                    </div>                                    
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Upload Blood Report (If have)</label>
                                        <input type="file" class="form-control" id="report" name="report">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Register</button>
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