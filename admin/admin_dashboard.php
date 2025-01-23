<?php 
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by checking the session for 'email'
    if(isset($_SESSION['email'])){
        // If 'add_show' is set (meaning the form is submitted)
        if(isset($_POST['add_show'])){
            // Include the database connection
            include('../connection.php');
            
            // Insert query to add a new show time to the 'shows' table
            $query = "insert into shows values(null,'$_POST[show_time]')";
            
            // Execute the query and store the result
            $query_run = mysqli_query($connection, $query);
            
            // If the query was successful, alert the user and redirect to the admin dashboard
            if($query_run){
                echo "<script type='text/javascript'>
                    alert('Show Time Added successfully...');
                    window.location.href = 'admin_dashboard.php';  
                </script>";
            }
            else{
                // If the query failed, alert the user and redirect to the admin dashboard
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
		<!-- Link to Bootstrap CSS for styling -->
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
		<!-- Link to custom CSS -->
		<link rel="stylesheet" href="../css/style.css">
    <!-- Link to jQuery -->
    <script type="text/javascript" src="../jquery/jquery_latest.js"></script>

    <script type="text/javascript">
      // jQuery function to load different sections into the dashboard
      $(document).ready(function(){
        // Load the 'viewUser.php' content when the 'view_user' button is clicked
        $("#view_user").click(function(){
          $("#load_section").load("viewUser.php");
        });
      });

      $(document).ready(function(){
        // Load the 'bookinghistory.php' content when the 'booking_history' button is clicked
        $("#booking_history").click(function(){
          $("#load_section").load("bookinghistory.php");
        });
      });

      $(document).ready(function(){
        // Load the 'cancelledbookings.php' content when the 'cancelled_bookings' button is clicked
        $("#cancelled_bookings").click(function(){
          $("#load_section").load("cancelledbookings.php");
        });
      });
    </script>
  </head>
  <body style="overflow-x: hidden; background-color:white;">
    <!-- Header section -->
    <div class="row" id="header">
      <div class="col-md-4">
        <h4 style="padding-left:15px;font-family:'Ariel';">MovieBooking</h4>
      </div>
      <div class="col-md-7" style="text-align: right;">
        <!-- Display the logged-in user's email and name -->
        <span style="padding-right:75px;"><?php echo "Email:" . " " . $_SESSION['email'];?></span>
        <span><?php echo "Welcome:" . " " . $_SESSION['name'];?></span>
      </div>
    </div>
    <!-- Sidebar navigation section -->
    <div class="row" style="margin:25px;">
      <div class="col-md-2" style="border-right:1px solid black;">
        <!-- Navigation buttons that load different sections -->
        <a class="btn btn-block" style="background-color: black; color: white;"id="view_user">View User</a> <br>
        <a class="btn btn-block" id="booking_history"  style="background-color: black; color: white;">Booking History</a> <br>
        <a class="btn btn-block" style="background-color: black; color: white;"id="cancelled_bookings">Cancelled Bookings</a><br>
        <a class="btn btn-block" style="background-color: black; color: white;"href="../logout.php">Logout</a> <br>
      </div>
      <div class="col-md-8" id="load_section" style="background-color: black;padding:25px;">
        <p style=" color:white">ALL DETAILS</p>
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
