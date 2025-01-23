<?php
	// Start the session to access session variables
	session_start();

	// Check if the login form is submitted
	if(isset($_POST['login'])){
    
    // Include the database connection
    include('../connection.php');
    
    // SQL query to check if the entered email and password match any record in the 'admins' table
    $query = "select * from admins where admin_email = '$_POST[email]' AND admin_password = '$_POST[password]'";
    
    // Execute the query and store the result
    $query_run = mysqli_query($connection, $query);
    
    // Check if a matching admin record is found
    if(mysqli_num_rows($query_run)){
        // If the admin exists, start the session and store admin details
        $_SESSION['email'] = $_POST['email']; // Store the email in the session
        while($row = mysqli_fetch_assoc($query_run)){
            $_SESSION['name'] = $row['admin_name']; // Store the admin's name
            $_SESSION['user_id'] = $row['admin_id']; // Store the admin's ID
        }
        // Redirect to the admin dashboard after successful login
        echo "<script type='text/javascript'>
            window.location.href = 'admin_dashboard.php';
        </script>";
    }
    else{
        // If no matching admin is found, show an error alert and redirect to the login page
        echo "<script type='text/javascript'>
            alert('Please enter correct email and password.');
            window.location.href = 'login.php';
        </script>";
    }
  }
?>

<html>
    <head>
        <title>Admin Login Page</title>
        <!-- Link to Bootstrap CSS for styling -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <!-- Link to custom CSS -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body style="background-color:white;">
        <!-- Header section -->
        <div class="row" id="header">
            <div class="col-md-4">
                <h4 style="padding-left:15px;font-family:'Ariel';">MovieBooking</h4>
            </div>
            <div class="col-md-7" style="text-align: right;">
                <!-- Navigation links -->
                <ul>
                    <li><a href="../index.php" class="active">Home</a></li>
                    <li><a href="../movies.php">Movies</a></li>
                    <li><a href="../register.php">Register</a></li>
                    <li><a href="../login.php">Login</a></li>
                    <li><a href="login.php">Admin Login</a></li>
                </ul>
            </div>
        </div>

        <!-- Login form section -->
        <div class="row">
            <div class="col-md-4" id="login_form">
                <center><h3 style="color: white;"><u>Admin Login form</u></h3></center>
                <!-- Form for the admin login -->
                <form action="" method="post">
                    <div class="form-group">
                        <label for="admin_email" style="color: white;">Email:</label>
                        <input class="form-control" type="text" name="email" placeholder="Enter your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="admin_password" style="color: white;">Password:</label>
                        <input class="form-control" type="password" name="password" placeholder="Enter the Password" required>
                    </div>
                    <button class="btn" type="submit" name="login" style="background-color: white; color: black;">Login</button><br>
                </form>
            </div>
        </div>
    </body>
</html>
