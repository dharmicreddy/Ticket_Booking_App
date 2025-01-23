<?php 
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying the 'email' session variable
    if(isset($_SESSION['email'])){
?>
<html>
    <head>
        <!-- Bootstrap CSS and JS for styling and interactivity -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Custom CSS files -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!-- Form layout for changing password -->
        <div class="row" style="margin:25px;">
            <div class="col-md-4">
                <center><h5 style="color: white;"><u>Reset Password</u></h5></center>
                
                <!-- Form to reset password -->
                <form action="" method="post">
                    <!-- Input for current password -->
                    <div class="form-group">
                        <label for="password" style="color: white;">Current Password:</label>
                        <input type="password" class="form-control" name="currPassword" placeholder="Current password" required>
                    </div>

                    <!-- Input for new password -->
                    <div class="form-group">
                        <label for="password" style="color: white;">New Password:</label>
                        <input type="password" class="form-control" name="newPassword1" placeholder="New password" required>
                    </div>

                    <!-- Input for confirming the new password -->
                    <div class="form-group">
                        <label for="password" style="color: white;">Confirm Password:</label>
                        <input type="password" class="form-control" name="newPassword2" placeholder="Confirm password" required>
                    </div>

                    <!-- Submit button to change the password -->
                    <input type="submit" class="btn" style="background-color: white; color: black;" value="Change Password" name="change_password">
                </form>
            </div>
        </div>
    </body>
</html>
<?php 
    }
    else{
        // If the user is not logged in, redirect to the login page
        header('location:login.php');
    }
?>
