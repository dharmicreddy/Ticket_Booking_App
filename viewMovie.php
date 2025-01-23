<?php
    // Start the session to access session variables
    session_start();

    // Include the database connection to interact with the database
    include('connection.php');
    
    // Fetch the movie details based on the movie ID passed in the URL
    $query = "select * from movies where movie_id = $_GET[mid]";
    
    // Initialize variables for storing movie details
    $movie_name = "";
    $movie_description = "";
    $movie_link = "";
    
    // Execute the query to fetch movie details
    $query_run = mysqli_query($connection,$query);
    
    // Fetch the result of the query and store the values in variables
    while($row = mysqli_fetch_assoc($query_run)){
        $movie_name = $row['movie_name'];
        $movie_description = $row['movie_description'];
        $movie_link = $row['movie_link']; 
    }
?>
<html>
    <head>
        <title>View Movie</title>
        
        <!-- Bootstrap CSS for styling -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
        
        <!-- Bootstrap JS for functionality -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Custom CSS for additional styling -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body style="background-color:white">
    
    <!-- Header section with navigation links -->
    <div class="row" id="header">
      <div class="col-md-4">
        <!-- Title in header -->
        <h4 style="padding-left:15px;font-family:'Comic Sans MS';">Book online movie ticket</h4>
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
    <!-- Header ends here -->

    <!-- Movie details section -->
    <br><br>
    <div class="row">
        <div class="col-md-6 m-auto" id="login_form">
        
        <!-- Movie details heading -->
        <center><h3><u>Movie detail</u></h3></center>
        
        <!-- Table to display movie details -->
        <table class="table">
            <thead>
                <tr>
                    <th>Movie Name</th>
                    <th>Movie Description</th>
                    <th>Trailer link</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- Display movie name, description, and trailer link -->
                    <td><?php echo $movie_name; ?></td>
                    <td><?php echo $movie_description; ?></td>
                    <td><a href="<?php echo $movie_link; ?>" target="_blank">Watch now</a></td>
                </tr>
            </tbody>
        </table><br>
        
        <!-- Button to book ticket (redirecting to the login page) -->
        <center><a href="login.php" class="btn btn-danger btn-sm">Book ticket</a></center>
        </div>
    </div>
    </body>
</html>
