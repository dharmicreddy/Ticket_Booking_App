<?php 
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying the 'email' session variable
    if(isset($_SESSION['email'])){
    
        // Handle 'add_show' form submission
        if(isset($_POST['add_show'])){
            // Include the database connection
            include('../connection.php');
            
            // SQL query to insert a new show time into the 'shows' table
            $query = "insert into shows values(null,'$_POST[show_time]')";
            
            // Execute the query and store the result
            $query_run = mysqli_query($connection, $query);
            
            // Check if the query was successful and redirect with a success message
            if($query_run){
                echo "<script type='text/javascript'>
                    alert('Show Time Added successfully...');
                    window.location.href = 'admin_dashboard.php';  
                </script>";
            }
            else{
                // Show error message and redirect back to the dashboard if the query fails
                echo "<script type='text/javascript'>
                    alert('Error...Plz try again.');
                    window.location.href = 'admin_dashboard.php';
                </script>";
            }
        }

        // Handle 'add_movie' form submission
        if(isset($_POST['add_movie'])){
            // Include the database connection
            include('../connection.php');
            
            // SQL query to insert a new movie into the 'movies' table
            $query = "insert into movies values(null,'$_POST[movie_name]','$_POST[movie_desc]','$_POST[link]','$_POST[logo]','$_POST[time]')";
            
            // Execute the query and store the result
            $query_run = mysqli_query($connection, $query);
            
            // Check if the query was successful and redirect with a success message
            if($query_run){
                echo "<script type='text/javascript'>
                    alert('Movie Added successfully...');
                    window.location.href = 'admin_dashboard.php';  
                </script>";
            }
            else{
                // Show error message and redirect back to the dashboard if the query fails
                echo "<script type='text/javascript'>
                    alert('Error...Plz try again.');
                    window.location.href = 'admin_dashboard.php';
                </script>";
            }
        }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"></link>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    
    <!-- Custom CSS for the dashboard -->
    <link rel="stylesheet" href="../css/style.css">
    
    <!-- jQuery for dynamic content loading -->
    <script type="text/javascript" src="../jquery/jquery_latest.js"></script>

    <script type="text/javascript">
      // jQuery function to load different content sections based on button clicks
      $(document).ready(function(){
        // Load 'addMovie.php' content when the 'Add Movie' button is clicked
        $("#add_movie").click(function(){
          $("#load_section").load("addMovie.php");
        });
      });

      $(document).ready(function(){
        // Load 'addShow.php' content when the 'Add Show' button is clicked
        $("#add_show").click(function(){
          $("#load_section").load("addShow.php");
        });
      });

      $(document).ready(function(){
        // Load 'viewUser.php' content when the 'View User' button is clicked
        $("#view_user").click(function(){
          $("#load_section").load("viewUser.php");
        });
      });
      
      $(document).ready(function(){
        // Load 'cancelledbookings.php' content when the 'Cancelled Bookings' button is clicked
        $("#cancelled_bookings").click(function(){
          $("#load_section").load("cancelledbookings.php");
        });
      });
    </script>
  </head>
  <body style="overflow-x: hidden; background-color:white;">
    
    <!-- Header section with movie booking app name and user info -->
    <div class="row" id="header">
      <div class="col-md-4">
        <h4 style="padding-left:15px;font-family:'Ariel';">MovieBooking</h4>
      </div>
      <div class="col-md-7" style="text-align: right;">
        <!-- Display user's email and name from the session -->
        <span style="padding-right:75px;"><?php echo "Email:" . " " . $_SESSION['email'];?></span>
        <span><?php echo "Welcome:" . " " . $_SESSION['name'];?></span>
      </div>
    </div>
    
    <!-- Sidebar with options to add movies, add shows, view users, and view cancelled bookings -->
    <div class="row" style="margin:25px;">
      <div class="col-md-2" style="border-right:1px solid black;">
        <!-- Buttons for various admin actions -->
        <a class="btn btn-block" style="background-color: black; color: white;"id="add_movie">Add Movie</a> <br>
        <a class="btn btn-block" style="background-color: black; color: white;"id="add_show">Add Show</a> <br>
        <a class="btn btn-block" style="background-color: black; color: white;"id="view_user">View User</a> <br>
        <a class="btn btn-block" style="background-color: black; color: white;"id="cancelled_bookings">Cancelled Bookings</a><br>
        <a class="btn btn-block" style="background-color: black; color: white;"href="../logout.php">Logout</a> <br>
      </div>
      
      <!-- Main content area where dynamic sections will be loaded -->
      <div class="col-md-8" id="load_section" style="background-color: black;padding:25px;">
        <p style=" color:white">USER INFORMATION</p>
      </div>
      
      <div class="col-md-2"></div>
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
