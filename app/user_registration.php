<?php include'includes/head.php'; ?>

        <div id="layoutSidenav">
            <?php include'includes/nav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">User Registration</li>
                        </ol>
                       
                        <div class="card mt-5 p-4">
                            <?php if (isset($_GET['msg'])) { 
                                $msg = $_GET['msg'];
                                echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
                            }?>
                        <h2>User Registration</h2>
                        <form action="dbhelper/register.php" method="POST">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">User Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="3">Doctor</option>
                                    <option value="2">Medical Assistant</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                        
                        
                    <?php
                    include 'dbhelper/db_con.php'; // Include your DB connection

                    // Query to fetch all users
                    $sql = "SELECT id, full_name, username, type, created_at FROM users";
                    $result = $conn->query($sql);

                    ?>
                    <div class="card mb-4 mt-5">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Registered Users
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Type</th>
                                    <th>Registration Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['full_name']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['type']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">No users found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    </div>
                </main>
                <?php include('includes/footer.php');?>
            </div>
        </div>
        <?php include('includes/footer_link.php');?>