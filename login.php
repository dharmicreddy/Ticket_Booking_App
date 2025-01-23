<?php
    // Start the session to access session variables
    session_start();

    // Check if the 'login' form is submitted
    if(isset($_POST['login'])){
    
        // Include the database connection
        include('connection.php');
        
        // SQL query to check if the entered email and password match any record in the 'users' table
        $query = "select * from users where user_email = '$_POST[email]' AND user_password = '$_POST[password]'";
        
        // Execute the query and store the result
        $query_run = mysqli_query($connection,$query);
        
        // Check if there is any result (user exists with matching credentials)
        if(mysqli_num_rows($query_run)){
            // Start the session and store user details in session variables
            $_SESSION['email'] = $_POST['email'];
            while($row = mysqli_fetch_assoc($query_run)){
                $_SESSION['name'] = $row['user_name']; // Store user name
                $_SESSION['user_id'] = $row['user_id']; // Store user ID
            }
            
            // Redirect to the user dashboard
            echo "<script type='text/javascript'>
                window.location.href = 'user_dashboard.php';
            </script>";
        }
        else{
            // If credentials don't match, show an alert and redirect to login page
            echo "<script type='text/javascript'>
                alert('Please Enter Valid Details');
                window.location.href = 'login.php';
            </script>";
        }
    }
?>

<html>
    <head>
        <title>Login Page</title>
        
        <!-- Bootstrap CSS for styling -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
        
        <!-- Bootstrap JS for functionality -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Custom CSS for the page -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body style="background-color:white;">
    
    <!-- Header section with navigation links -->
    <div class="row" id="header">
      <div class="col-md-4">
        <!-- MovieBooking title in header -->
        <h4 style="padding-left:15px;font-family:'Ariel';">MovieBooking</h4>
      </div>
      <div class="col-md-7" style="text-align: right;">
        <!-- Navigation links for Home, Movies, Register, and Login -->
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="movies.php">Movies</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
    
    <!-- Main content: User Login form -->
    <div class="row">
        <div class="col-md-4" id="login_form">
        <center><h3 style="color: white;"><u>User Login form</u></h3></center>
        
        <!-- Form for user login -->
        <form action="" method="post">
            <div class="form-group">
                <label for="user_email" style="color: white;">Email:</label>
                <input class="form-control" type="text" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="form-group">
                <label for="user_password" style="color: white;">Password:</label>
                <input class="form-control" type="password" name="password" placeholder="Enter the Password" required>
            </div>
            <button class="btn" type="submit" name="login" style="background-color: white; color: black;">Login</button><br>
        </form>
        </div>
    </div>
    </body>
</html>
