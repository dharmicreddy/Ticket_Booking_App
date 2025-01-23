<?php
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying the 'email' session variable
    if(isset($_SESSION['email'])){
    
    // Initialize variables for storing booking details
    $booked_seats = "";
    $booking_time = "";
    
    // Include the database connection to interact with the database
    include('connection.php');
    
    // SQL query to fetch bookings where the user is not canceled and the user_id exists in the users table
    $query = "select * from booking where booking_is_cancel = 0 and booking_user_id = ANY(select user_id from users)";
    
    // Execute the query and store the result
    $query_run = mysqli_query($connection,$query);
?>
<html>
  <body>
    <div class="row">
      <div class="col-md-4">
        <!-- Displaying Booking Details Header -->
        <center><h3 style="color: white;"><u>Booking Details</u></h3></center><br><br>
        
        <?php 
          // Loop through each booking record fetched by the query
          while($row = mysqli_fetch_assoc($query_run)){
            // Fetch the booked seats and booking time
            $booked_seats = $row['booking_booked_seats']; 
            $booking_time = $row['booking_time'];
            
            // Check if the user has made any booking
            if($booked_seats == ""){
                echo "There is no Booking!!";  // If no booking found, display a message
            }
            else{
                // Display booked seats and other booking details
                echo '<p style="color: white;">You Booked:</p>';
                
                // Loop through the serialized booked seats and display them
                foreach (unserialize($booked_seats) as $seat){
                    echo '<span style="color: white;">' . $seat . '</span> , ';
                }

                // Display movie name, show time, price, and booking time
                echo '<p class="movie-name" style="color: white;">Movie Name: ' . $row['booking_movie_name'] . '</p>';
                echo '<p class="show-time" style="color: white;">Show Time: '. $row['booking_show_time'] . '</p>';
                echo '<p class="price" style="color: white;">Price: Rs. 300/-</p>';
                echo '<p class="booking-time" style="color: white;">Booking time: ' . $booking_time . '</p>';
            }
          }
        ?>
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
