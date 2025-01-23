<?php 
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying the 'email' session variable
    if(isset($_SESSION['email'])){
    
    // Include the database connection to interact with the database
    include('connection.php');

    // SQL query to fetch the current user's details based on the session email
    $query1 = "select * from users where user_email = '$_SESSION[email]'";
    
    // Execute the query and store the result
    $query_run1 = mysqli_query($connection,$query1);

    // Initialize variables to store the user's details
    $name = "";
    $email = "";
    $mobile = "";

    // Fetch the user's details from the result and store them in the variables
    while($row = mysqli_fetch_assoc($query_run1)){
        $name = $row['user_name'];
        $email = $row['user_email'];
        $mobile = $row['user_mobile'];
    }
?>
<html>
    <head>
        <!-- Bootstrap CSS for styling -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<!-- Custom CSS for additional styling -->
		<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!-- Main content section for updating user profile -->
        <div class="row" style="margin:25px;">
            <div class="col-md-4">
                <!-- Heading for update profile section -->
                <center><h5 style="color: white;"><u>Update Profile</u></h5></center>

                <!-- Form to update user profile details -->
                <form action="" method="post">
                    <!-- Input field for user name -->
                    <div class="form-group">
                        <label for="user_name" style="color: white;">Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                    </div>
                    
                    <!-- Input field for user email -->
                    <div class="form-group">
                        <label for="user_email" style="color: white;">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
                    
                    <!-- Input field for user mobile number -->
                    <div class="form-group">
                        <label for="user_mobile" style="color: white;">Mobile:</label>
                        <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                    </div>
                    
                    <!-- Submit button to update the profile -->
                    <input type="submit" class="btn" style="background-color: white; color: black;" value="Update" name="update">
                </form>
            </div>
        </div>
    </body>
</html>
<?php  
    // If the user is not logged in, redirect to the login page
    }
    else{
        header('location:login.php');
    }
?>
