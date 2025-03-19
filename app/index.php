<?php
// Start session
session_start();

// Check if the user is logged in
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     $error = "Please Login First.";
// }

// Database connection details
$servername = "localhost";
$username = "root"; // Database username
$password = "";     // Database password
$dbname = "chms"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs from the login form
    $inputEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to check if user exists
    $sql = "SELECT id, username, type, password FROM users WHERE username = ?";
    
    // Prepare and bind the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $inputEmail);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with that email exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $email, $userType, $storedPassword);
            $stmt->fetch();

            // Check if the password matches (without hashing)
            if ($inputPassword === $storedPassword) {
                // Password is correct, start the session
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $id;
                $_SESSION['user_type'] = $userType; //

                // Redirect to dashboard or another page
                if($userType == 1)
                    header('Location: dashboard.php');
                else if($userType == 2)
                    header('Location: dashboard.php');
                else if($userType == 3)
                    header('Location: dashboard_doctor.php');
                
                exit;
            } else {
                // Incorrect password
                $error = "Invalid password.";
            }
        } else {
            // No user found with that email
            $error = "No account found with that email.";
        }

        $stmt->close();
    }
}

// Close connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
            max-width: 400px;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .login-container .form-control {
            border-radius: 30px;
        }

        .login-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container .btn-primary {
            border-radius: 30px;
        }

        .login-container p {
            text-align: center;
            margin-top: 10px;
        }
        .form-group{
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="login-container col-md-6 col-lg-4">
            <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <h3>Login</h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <p class="mt-3">Don't have an account? <a href="#">Contact Admin</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
