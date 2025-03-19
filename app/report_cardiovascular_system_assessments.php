<?php 
include 'dbhelper/db_con.php';

// Query to get all assessments with patient details
$sql = "SELECT 
            p.case_number, 
            p.first_name, 
            p.last_name, 
            p.gender,
            p.dob, 
            p.contact_number,
            p.email,
            
            p.report,
            pa.breathlessness, 
            pa.pulse_rate, 
            pa.respiratory_rate, 
            pa.blood_pressure, 
            pa.created_at
        FROM cardiovascular_system_assessments pa
        JOIN patients p ON pa.case_number = p.case_number
        ORDER BY pa.created_at DESC";

$result = $conn->query($sql);

include'includes/head.php'; 
?>

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
        <h2 class="mb-4">List of All Cardiovascular System Assessments</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Case Number</th>
                        <th>Patient Name</th>
                        <th>Breathlessness</th>
                        
                        <th>Pulse Rate</th>
                        <th>Respiratory Rate</th>
                        <th>Blood Pressure</th>                        
                        <th>Report</th>
                        <th>Date of Assessment</th>
                        <th>View All</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                        <td><?php echo $row['case_number']; ?></td>
                        <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                            <td><?php echo $row['breathlessness']; ?></td>
                            
                            <td><?php echo $row['pulse_rate']; ?></td>
                            <td><?php echo $row['respiratory_rate']; ?></td>
                            <td><?php echo $row['blood_pressure']; ?></td>
                            
                            <td><?php echo $row['report']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                            <?php if ($_SESSION['user_type'] == 3): ?>
                                <a href="cardiovascular_system_assessments_details_doctor.php?case_number=<?php echo $row['case_number']; ?>" class="btn btn-primary btn-sm">View Details.</a>
                                <?php else: ?>
                                     <a href="cardiovascular_system_assessments_details.php?case_number=<?php echo $row['case_number'];?>" class="btn btn-primary btn-sm">View Details.</a>
                            <?php endif;?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No assessments found.</p>
        <?php endif; ?>
    </div>   

                        
                    </div>
                </main>
                <?php include('includes/footer.php');?>
            </div>
        </div>
        <?php include('includes/footer_link.php');?>