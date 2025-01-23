<?php
  // Start the session to access session variables
  session_start();

  // Check if the user is logged in by checking if 'email' session variable is set
  if(isset($_SESSION['email'])){
  
    // Include the database connection
    include('../connection.php');
    
    // SQL query to select booking details from the 'allbookings' table
    $query = "select booking_id, booking_user_id, booking_movie_name from allbookings"; 
    
    // Execute the query and store the result
    $query_run = mysqli_query($connection, $query);
    
    // Initialize a variable to track serial numbers
    $sn = 0;

    // Display the table title
    echo "<center><h4 style='color: white;'><u>List of all Bookings</u></h4></center><br>";
    
    // Start the HTML table with headers
    echo "<table class='table' style='color: white;'>
      <tr>
        <th>S.No</th>
        <th>BookingID</th>
        <th>Userid</th>
        <th>MovieName</th>
      </tr>";
    
    // Loop through the result set and display each row in the table
    while($row = mysqli_fetch_assoc($query_run)){
      $sn = $sn + 1;
      echo "
        <tr>
          <td>$sn</td>
          <td>$row[booking_id]</td>
          <td>$row[booking_user_id]</td>
          <td>$row[booking_movie_name]</td>
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
