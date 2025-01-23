<?php
  // Start the session to access session variables
  session_start();

  // Check if the user is logged in by verifying if the 'email' session variable is set
  if(isset($_SESSION['email'])){
    
    // Include the database connection
    include('../connection.php');
    
    // SQL query to fetch all users from the 'users' table
    $query = "select * from users";
    
    // Execute the query and store the result
    $query_run = mysqli_query($connection, $query);
    
    // Initialize a variable to track the serial number for the table
    $sn = 0;

    // Display the table title
    echo "<center><h4 style='color: white;'><u>List of Users</u></h4></center><br>";
    
    // Start the HTML table and define the headers
    echo "<table class='table' style='color: white;'>
      <tr>
        <th style='color: white;'>S.No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
      </tr>";
    
    // Loop through the result set and display each user's details in the table
    while($row = mysqli_fetch_assoc($query_run)){
      $sn = $sn + 1; // Increment serial number
      $id = $row['user_id']; // Store the user ID (although it's not used in the current code)
      
      // Output each user's details in a table row
      echo "
        <tr>
          <td>$sn</td>
          <td style='color: white;'>$row[user_name]</td>
          <td>$row[user_email]</td>
          <td>$row[user_mobile]</td>
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
