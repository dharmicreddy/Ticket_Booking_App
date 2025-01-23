<?php 
  // Include the database connection to interact with the database
  include('connection.php');
  
  // SQL query to select movies released in 2023 with any rating from the movies table
  $query1 = "select * from movies where YEAR(movie_releasedate)=2023 and movie_rating = ANY (select movie_rating from movies)";
  
  // Execute the query and store the result
  $query_run1 = mysqli_query($connection, $query1);
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
    
    <!-- Main content: List of movies released in 2023 -->
    <br>
    <center><h3><u>List of Movies released in 2023</u></h3></center>
    
    <!-- Displaying movies as cards -->
    <div class="row" style="margin:20px;">
      <?php 
        // Loop through each movie fetched by the query
        while($row = mysqli_fetch_assoc($query_run1)) { 
      ?>
        <!-- Each movie displayed as a card with its logo -->
        <div class="col-md-3">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="images/<?php echo $row['movie_logo']; ?>" alt="Card image cap">
            <div class="card-body">
              <!-- Book ticket button (currently redirects to login page) -->
              <a href="login.php" class="btn" style="background-color: #000; color: white;">Book ticket</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </body>
</html>
