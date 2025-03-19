<style type="text/css">
.stats-card .card-body {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-end;
    height: 100%;
}

.stats-card .card-body span:first-child {
    margin-bottom: -0.5rem; /* Adjust this value as needed */
    margin-right: 0.5rem; /* Adjust this value as needed */
    order: 2;
}

.stats-card .card-body span:last-child {
    order: 1;
}

</style>

<?php
include 'dbhelper/db_con.php'; // Include your DB connection

// Total Registered Cases
$sql_total_cases = "SELECT COUNT(*) AS total_cases FROM patients";
$result_total_cases = $conn->query($sql_total_cases);
$total_cases = $result_total_cases->fetch_assoc()['total_cases'];

// Today's Registered Cases
$sql_today_cases = "SELECT COUNT(*) AS today_cases FROM patients WHERE DATE(registration_date) = CURDATE()";
$result_today_cases = $conn->query($sql_today_cases);
$today_cases = $result_today_cases->fetch_assoc()['today_cases'];

// Cases with Doctor Notes (cases where prescription or comments are filled in doctor_notes table)
$sql_cases_with_reply = "
    SELECT COUNT(DISTINCT case_number) AS cases_with_reply 
    FROM doctor_notes 
    WHERE (prescription IS NOT NULL AND prescription != '') 
    OR (comments IS NOT NULL AND comments != '')
";
$result_cases_with_reply = $conn->query($sql_cases_with_reply);
$cases_with_reply = $result_cases_with_reply->fetch_assoc()['cases_with_reply'];

// Pending Cases (cases that have no entry in doctor_notes table)
$sql_pending_cases = "
    SELECT COUNT(*) AS pending_cases 
    FROM patients 
    WHERE case_number NOT IN (
        SELECT DISTINCT case_number 
        FROM doctor_notes 
        WHERE (prescription IS NOT NULL AND prescription != '') 
        OR (comments IS NOT NULL AND comments != '')
    )";
$result_pending_cases = $conn->query($sql_pending_cases);
$pending_cases = $result_pending_cases->fetch_assoc()['pending_cases'];

$conn->close();
?>


<div class="row stats-card">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4 py-3">
            <div class="card-body">
                <span>Today Registered Cases </span>
                <span class="h1"><?php echo $today_cases; ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4 py-3">
            <div class="card-body"><span>Total cases </span>
                <span class="h1"><?php echo $total_cases; ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4 py-3">
            <div class="card-body">
                <span>Doctores Responses </span>
                <span class="h1"><?php echo $cases_with_reply; ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4 py-3">
            <div class="card-body">
                <span>Pending cases </span>
                <span class="h1"><?php echo $pending_cases; ?></span>
            </div>
        </div>
    </div>
</div>