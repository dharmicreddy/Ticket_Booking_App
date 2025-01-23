<?php
  // Start the session to access session variables
  session_start();

  // Check if the user is logged in by verifying the 'email' session variable
  if(isset($_SESSION['email'])) {
    // Initialize variables to store booking details
    $booked_seats = "";
    $booking_time = "";
    
    // Include the database connection
    include('connection.php');
    
    // SQL query to fetch bookings for the current user where booking is not cancelled
    $query = "select * from booking where booking_user_id = $_SESSION[user_id] and booking_is_cancel = 0";
    // Execute the query and store the result
    $query_run = mysqli_query($connection, $query);
?>
<html>
  <body>
    <div class="row">
      <div class="col-md-4">
      <center><h3 style="color: white;"><u>Your Booking details</u></h3></center><br><br>
        <?php 
          // Loop through the query result to display booking details
          while($row = mysqli_fetch_assoc($query_run)){
            $booked_seats = $row['booking_booked_seats']; // Fetch booked seats
            $booking_time = $row['booking_time']; // Fetch booking time
            $booking_id = $row['booking_id']; // Fetch booking ID
            
            // Check if there are no booked seats
            if($booked_seats == ""){
              echo "There is no Booking!!"; // Display message if no booking is found
            }
            else{
              // Display booking details if seats are booked
              echo '<p style="color: white;">You Booked:</p>';
              foreach (unserialize($booked_seats) as $seat){
                echo '<span style="color: white;">' . $seat . '</span> , '; // Display each booked seat
              }
              echo '<p class="movie-name" style="color: white;">Movie Name: ' . $row['booking_movie_name'] . '</p>'; // Display movie name
              echo '<p class="show-time" style="color: white;">Show Time: '. $row['booking_show_time'] . '</p>'; // Display show time
              echo '<p class="booking-time" style="color: white;">Booking time: ' . $booking_time . '</p>'; // Display booking time
        ?>
            <!-- Link to cancel the booking -->
            <a href="confirm_cancel.php?tid=<?php echo $booking_id; ?>" class="btn" style="background-color: white; color: black;">Cancel ticket</a>
            <?php 
              echo "<br>"; // Line break after each booking display
            }
          }
        ?>
      </div>
    </div>
  </body>
</html>
<?php 
  } else {
    // If the user is not logged in, redirect to the login page
    header('location:login.php');
  }
?>
