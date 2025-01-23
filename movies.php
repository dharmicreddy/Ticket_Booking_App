<?php 
  // Include the database connection
  include('connection.php');
  
  // Call the stored procedure to retrieve all movies and their logos
  $query = "CALL get_all_movies_logo()";
  $query_run1 = mysqli_query($connection, $query);
?>
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
    
    <!-- Header section with navigation links -->
    <div class="row" id="header">
      <div class="col-md-4">
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
    
    <!-- Main content: Movie list and action buttons -->
    <br>
    <center><h3><u>List of Movies</u></h3></center>  
    
    <!-- Action buttons for different categories of movies -->
    <div style="text-align: center;">
      <a href="report.php" class="btn" style="background-color: #000; color: white;">Group By Latest</a>
    </div>
    <div style="text-align: center; margin-top: 10px">
      <a href="rating.php" class="btn" style="background-color: #000; color: white;">Highest Rating Movies</a>
    </div>
    <div style="text-align: center; margin-top: 10px">
      <a href="movies_ratings.php" class="btn" style="background-color: #000; color: white;">Users with multiple booking on same day</a>
    </div>
    <div style="text-align: center; margin-top: 10px">
      <a href="nested.php" class="btn" style="background-color: #000; color: white;">Movies Released in 2023</a>
    </div>
    
    <!-- Movie list displayed as cards -->
    <div class="row" style="margin:20px;">
      <?php 
        // Loop through the result of the stored procedure and display movie logos
        while($row = mysqli_fetch_assoc($query_run1)) { 
      ?>
        <!-- Each movie displayed as a card -->
        <div class="col-md-3">
          <div class="card" style="width: 18rem;">
            <!-- Movie logo image -->
            <img class="card-img-top" src="images/<?php echo $row['movie_logo']; ?>" alt="Card image cap">
            <div class="card-body">
              <!-- Book ticket button (currently redirects to login page) -->
              <a href="login.php" class="btn" style="background-color: #000; color: white;">Book Ticket</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </body>
</html>
