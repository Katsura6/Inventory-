<?php
// Include the connection file
include('../../db_connect.php'); // Include database connection file

// Start the session
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Prepare SQL query to get user from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $username); // 's' means string, bind the username as a parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and verify password
    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            // Generate a session ID if user successfully logs in
            session_regenerate_id(true); // Regenerate session ID to prevent session fixation attacks

            // Store session data for logged-in user
            $_SESSION['user_name'] = $username;
            $_SESSION['user_id'] = $row['id']; // You can store the user's ID or other details

            // Redirect to the welcome page (or dashboard)
            header("Location: ../../index.php"); 
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="loginstyle.css">
    <style>
        /* Custom styling for the layout */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            flex-wrap: wrap; /* Allows the layout to wrap on small screens */
        }
       
        footer{
            margin-top: 0;
            height: 10vh;
        }

        .welcome-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 450px;
            width: 100%;
        }

        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 450px; /* Limit width for larger screens */
            width: 100%;
            margin-bottom: 30px; /* Add space between the elements */
        }

        .card {
            width: 100%;
        }

        .alert {
            text-align: center;
        }

        /* Make the welcome message smaller on mobile */
        .welcome-message h2 {
            font-size: 1.5rem;
            text-align: center;
        }

        .input-group-text {
            cursor: pointer;
        }


        /* Ensure the layout stacks for mobile */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack elements vertically */
                justify-content: flex-start;
            }

            .welcome-container {
                margin-bottom: 20px; /* Add space between sections */
            }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
        <!-- Left side: Welcome Message -->
        <div class="welcome-container">
            <div class="welcome-message">
                <h2>Welcome to Papart's Inventory Management System</h2>
            </div>
        </div>

        <!-- Right side: Login Form -->
        <div class="login-container">
            <div class="card p-4 shadow-lg">
                <h2 class="text-center mb-4">Login</h2>
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="input-group-text" id="show-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>   
            </div>
        </div>
    
    </div>

    <footer class="text-center text-white  py-3 " style="margin-top: 50px;">
                <?php include('../component/footer.php') ?>
   </footer>

    <script>
        document.getElementById("show-password").addEventListener("click", function() {
            var passwordField = document.getElementById("password");
            var icon = this.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>

    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
