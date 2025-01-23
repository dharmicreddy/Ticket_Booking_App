<?php 
  // Include the database connection
  include('connection.php');

  // SQL query to update the booking and mark it as cancelled (booking_is_cancel = 1)
  $query = "update booking set booking_is_cancel = 1 where booking_id = '$_GET[tid]'";

  // Execute the query and store the result
  $query_run = mysqli_query($connection, $query);

  // If the query was successful, show a success message and redirect to the user dashboard
  if($query_run){
    echo "<script type='text/javascript'>
      alert('Tickets Cancelled successfully...');
      window.location.href = 'user_dashboard.php';  
    </script>";
  }
  else{
    // If an error occurs during the query execution, show an error message and redirect back to the user dashboard
    echo "<script type='text/javascript'>
      alert('Error...Plz try again.');
      window.location.href = 'user_dashboard.php';
    </script>";
  }
?>
