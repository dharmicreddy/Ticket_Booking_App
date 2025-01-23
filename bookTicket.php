<?php 
    // Start the session to access session variables
    session_start();

    // Initialize an empty array for seats and a variable for the time
    $seats = [];
    $time = "";

    // Check if the "next" button is clicked to proceed with seat booking
    if(isset($_POST['next'])){
        // Include the database connection
        include('connection.php');
        
        // SQL query to fetch the booked seats for the selected movie that is not cancelled
        $query = "select booking_booked_seats from booking where booking_is_cancel = 0 and booking_movie_name='$_POST[movie_name]'";
        
        // Execute the query and store the result
        $query_run = mysqli_query($connection, $query);
        
        // If there are any results, merge the booked seats into the $seats array
        if(mysqli_num_rows($query_run)){
            while($row = mysqli_fetch_assoc($query_run)){
                $booked_seat = $row['booking_booked_seats'];
                $seats = array_merge($seats, unserialize($booked_seat));
            }
        }
    }

    // Handle "confirm_booking" form submission to confirm the booking
    if(isset($_POST['confirm_booking'])){
        // Include the database connection
        include('connection.php');
        
        // Serialize the selected booked seats
        $booked_seats = serialize($_POST['booked_seat']);
        // Store the selected movie name, show time, and user ID
        $movie_name = $_POST['movie_name'];
        $show_time = $_POST['time'];
        $user_id = $_SESSION['user_id'];

        // SQL query to insert the booking into the 'booking' table
        $query = "insert into booking values(null,'$booked_seats','$user_id','$movie_name','$show_time',null,0)";
        
        // Execute the query and check if the insertion was successful
        $query_run = mysqli_query($connection, $query);
        if($query_run){
            echo "<script type='text/javascript'>
                alert('Tickets booked successfully...');
                window.location.href = 'user_dashboard.php';  
            </script>";
        }
        else{
            // If an error occurs, show an alert and redirect back to the user dashboard
            echo "<script type='text/javascript'>
                alert('Error...Plz try again.');
                window.location.href = 'user_dashboard.php';
            </script>";
        }
    }
?>

<html>
    <head>
        <!-- Bootstrap CSS and JS for styling and interactivity -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Custom CSS files -->
        <link rel="stylesheet" href="css/style.css">
        
        <!-- jQuery for dynamic content manipulation -->
        <script type="text/javascript" src="jquery/jquery_latest.js"></script>
    </head>
    <body style="background-color:white;"><br><br>
        <div class="row" style="margin:25px;text-align:center;">
            <div class="col-md-8 m-auto">
                <h5><u>Book movie ticket</u></h5><br>
                <!-- Form to select the movie and book seats -->
                <form action="" method="post">
                    <label><b>Movie: </b></label>
                    <input type="hidden" name="movie_name" value="<?php echo $_POST['movie_name']; ?>">
                    <?php echo $_POST['movie_name']; ?>
                    &nbsp;&nbsp;&nbsp;
                    
                    <!-- Fetch and display show time for the selected movie -->
                    <?php
                        include('connection.php');
                        $query = "select movie_time from movies where movie_name='$_POST[movie_name]'";
                        $query_run = mysqli_query($connection, $query);
                        if(mysqli_num_rows($query_run)){
                            while($row = mysqli_fetch_assoc($query_run)){
                                $time = $row['movie_time'];                                 
                            }
                        }
                    ?>
                    <label><b>Show: </b></label>
                    <?php echo $time; ?>
                    <input type="hidden" name="time" value="<?php echo $time; ?>">                        
                    <br><br>
                    
                    <!-- Table displaying seats with checkboxes. Disabled checkboxes for already booked seats -->
                    <table style="margin-left: 400px;">
                        <tr>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="A1" style="width:25px;height: 25px;" <?php if(in_array("A1", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="A2" style="width:25px;height: 25px;" <?php if(in_array("A2", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="A3" style="width:25px;height: 25px;" <?php if(in_array("A3", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="A4" style="width:25px;height: 25px;" <?php if(in_array("A4", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="A5" style="width:25px;height: 25px;" <?php if(in_array("A5", $seats)){?> disabled <?php } ?>>
                            </td>
                        </tr>
                        <tr>
                            <td>        
                                <input  type="checkbox" name="booked_seat[]" value="B1" style="width:25px;height: 25px;" <?php if(in_array("F16", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="B2" style="width:25px;height: 25px;" <?php if(in_array("F17", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="B3" style="width:25px;height: 25px;" <?php if(in_array("F18", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="B4" style="width:25px;height: 25px;" <?php if(in_array("F19", $seats)){?> disabled <?php } ?>>
                            </td>
                            <td>
                                <input  type="checkbox" name="booked_seat[]" value="B5" style="width:25px;height: 25px;" <?php if(in_array("F20", $seats)){?> disabled <?php } ?>>
                            </td>
                        </tr>
                    </table><br>
                    
                    <!-- Submit button to confirm booking -->
                    <input type="submit" class="btn" style="background-color: black; color: white;" name="confirm_booking" value="Confirm">
                </form>
                
                <!-- Link to go back to the user dashboard -->
                <a href="user_dashboard.php" class="btn" style="background-color: black; color:white">Go Back</a>
            </div>
        </div>
    </body>
</html>
