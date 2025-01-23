<?php
    // Check if the 'register' form is submitted
    if(isset($_POST['register'])){
        
        // Include the database connection to interact with the database
        include('connection.php');
        
        // SQL query to insert user data into the 'users' table
        $query = "insert into users values(null,'$_POST[name]','$_POST[email]','$_POST[password]',$_POST[mobile])";
        
        // Execute the query and store the result
        $query_run = mysqli_query($connection, $query);
        
        // Check if the query was successful
        if($query_run){
            // If successful, show a success message and redirect to login page
            echo "<script type='text/javascript'>
                alert('Registration Successfull');
                window.location.href = 'login.php';  
            </script>";
        }
        else{
            // If the query fails, show an error message and redirect back to the register page
            echo "<script type='text/javascript'>
                alert('Error.. Please Enter Valid Credentials');
                window.location.href = 'register.php';
            </script>";
        }
    }
?>
<html>
    <head>
        <title>Register Page</title>
        
        <!-- Bootstrap CSS for styling -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
        
        <!-- Bootstrap JS for functionality -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Custom CSS for additional styling -->
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
        <!-- Navigation links -->
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
          <li><a href="movies.php">Movies</a></li>
          <li><a href="register.php">Register</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
    
    <!-- Main content: User registration form -->
    <div class="row">
        <div class="col-md-4" id="login_form">
        <center><h3 style="color: white;"><u>User registration form</u></h3></center>
        
        <!-- Form for user registration -->
        <form action="" method="post">
            <div class="form-group">
                <label for="user_name" style="color: white;">Name:</label>
                <input class="form-control" type="text" name="name" placeholder="Enter your Name" required>
            </div>
            <div class="form-group">
                <label for="user_email" style="color: white;">Email:</label>
                <input class="form-control" type="text" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="form-group">
                <label for="user_password" style="color: white;">Password:</label>
                <input class="form-control" type="password" name="password" placeholder="Enter the Password" required>
            </div>
            <div class="form-group">
                <label for="user_mobile" style="color: white;">Mobile:</label>
                <input class="form-control" type="text" name="mobile" placeholder="Enter Mobile Number" required>
            </div>
            
            <!-- Register button -->
            <button class="btn" type="submit" name="register" style="background-color: white; color: black;">Register</button><br>
        </form>
        </div>
    </div>
    </body>
</html>
