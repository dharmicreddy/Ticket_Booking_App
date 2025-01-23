<?php
  // Include the database connection file
  include('../connection.php');

  // SQL query to delete a user based on the 'id' passed via the GET parameter
  $query = "delete from users where id = $_GET[id]";

  // Execute the query and store the result
  $query_run = mysqli_query($connection, $query);

  // If the query was successful, show a success message and redirect to the admin dashboard
  if($query_run){
    echo "<script type='text/javascript'>
      alert('User Deleted successfully...');
      window.location.href = 'admin_dashboard.php';
    </script>";
  }
  else{
    // If the query failed, show an error message and redirect to the admin dashboard
    echo "<script type='text/javascript'>
      alert('Failed...Plz try again.');
      window.location.href = 'admin_dashboard.php';
    </script>";
  }
?>
