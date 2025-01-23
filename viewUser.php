<?php
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying the 'email' session variable
    if(isset($_SESSION['email'])){
    
    // Include the database connection to interact with the database
    include('../connection.php');
    
    // SQL query to fetch all users from the 'users' table
    $query = "select * from users";
    $query_run = mysqli_query($connection,$query);
    
    // Initialize the serial number for listing users
    $sn = 0;
    
    // Display the heading for the user list
    echo "<center><h4 style='color: white;'><u>List of Users</u></h4></center><br>";
    
    // Start the HTML table to display the users' information
    echo "<table class='table' style='color: white;'>
            <tr>
                <th style='color: white;'>S.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>";
    
    // Loop through each user in the query result and display the user data in the table
    while($row = mysqli_fetch_assoc($query_run)){
        $sn = $sn + 1;
        $id = $row['id'];  // Get the user ID for the delete action
        echo "
            <tr>
                <td>$sn</td>
                <td style='color: white;'>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[mobile]</td>
                <!-- Link to delete the user, passing the user ID in the URL -->
                <td><a href='deleteUser.php?id=$id'>Delete</a></td>
            </tr>
        ";
    }
    
    // End the table after looping through all users
    echo "</table>";
    }
    else{
        // If the user is not logged in, redirect to the login page
        header('location:login.php');
    }
?>
