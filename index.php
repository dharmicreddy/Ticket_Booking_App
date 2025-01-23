<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
    
    <!-- Bootstrap JS for functionality -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> 
    
    <!-- Custom CSS for additional styling -->
    <link rel="stylesheet" href="css/style.css"> 
  </head>
  <body style="overflow-x: hidden; background-color:white;">
    
    <!-- Header section starts here -->
    <div class="row" id="header">
      <div class="col-md-4">
        <!-- MovieBooking title in header -->
        <h4 style="padding-left:15px;font-family:'Ariel';">MovieBooking</h4>
      </div>
      <div class="col-md-7" style="text-align: right;">
        <!-- Navigation links in header -->
        <ul>
          <li><a href="index.php" class="active">Home</a></li> <!-- Home link -->
          <li><a href="movies.php">Movies</a></li> <!-- Movies link -->
          <li><a href="register.php">Register</a></li> <!-- Register link -->
          <li><a href="login.php">Login</a></li> <!-- Login link -->
          <li><a href="admin/login.php">Admin Login</a></li> <!-- Admin Login link -->
        </ul>
      </div> 
    </div>

    <!-- Main content section for welcome message -->
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
      <h3 style="text-align: center;">WELCOME TO MOVIE TICKET BOOKING SYSTEM</h3>
    </div>
  </body>
</html>
