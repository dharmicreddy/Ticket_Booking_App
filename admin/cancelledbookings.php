<?php
  // Start the session to access session variables
  session_start();

  // Check if the user is logged in by verifying if the 'email' session variable is set
  if(isset($_SESSION['email'])){
  
    // Include the database connection
    include('../connection.php');
    
    // SQL query to select booking ID and user name for bookings that have been cancelled (booking_is_cancel=1)
    // It uses an INNER JOIN to match the 'booking_user_id' in the 'booking' table with 'user_id' in the 'users' table
    $query = "SELECT booking.booking_id, users.user_name FROM booking INNER JOIN users ON booking.booking_user_id = users.user_id AND booking.booking_is_cancel = 1";
    
    // Execute the query and store the result
    $query_run = mysqli_query($connection, $query);
    
    // Initialize a variable to track the serial number
    $sn = 0;

    // Display the table title for cancelled bookings
    echo "<center><h4 style='color: white;'><u>List of Cancelled Bookings</u></h4></center><br>";
    
    // Start the HTML table and add column headers
    echo "<table class='table' style='color: white;'>
      <tr>
        <th>S.No</th>
        <th>BookingID</th>
        <th>UserName</th>
      </tr>";
    
    // Loop through the result set and display each cancelled booking in the table
    while($row = mysqli_fetch_assoc($query_run)){
      $sn = $sn + 1;
      echo "
        <tr>
          <td>$sn</td>
          <td>$row[booking_id]</td>
          <td style='color: white;'>$row[user_name]</td>
        </tr>
      ";
    }
    
    // End the table
    echo "</table>";
  }
  else{
    // If the user is not logged in, redirect to the login page
    header('location:login.php');
  }
?>
