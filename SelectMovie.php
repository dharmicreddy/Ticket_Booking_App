<?php 
    // Start the session to access session variables
    session_start();

    // Check if the user is logged in by verifying the 'email' session variable
    if(isset($_SESSION['email'])){
?>
<html>
    <head>
        <!-- Bootstrap CSS for styling -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
		
		<!-- Bootstrap JS for functionality -->
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Custom CSS for additional styling -->
		<link rel="stylesheet" href="css/style.css">
        
        <!-- jQuery file (commented out as it’s not being used) -->
        <script type="text/javascript" src="jquery/jquery_latest.js"></script>

        <script type="text/javascript">
            // Uncommented jQuery for dynamic actions if needed
            // $(document).ready(function(){
            //     $("#next").click(function(){
            //     $("#load_section").load("bookTicket.php");
            //     });
            // });
        </script>
    </head>
    <body>
        <!-- Main content section with a form for movie selection -->
        <div class="row" style="margin:25px;">
            <div class="col-md-4">
                <!-- Header for selecting a movie -->
                <center><h5 style="color: white;"><u>Select movie</u></h5></center>
                
                <!-- Form to submit movie selection -->
                <form action="bookTicket.php" method="post">
                    <!-- Label for movie selection -->
                    <label style="color: white;"><b>Movie: </b></label>
                    
                    <!-- Dropdown for selecting a movie -->
                    <select name="movie_name">
                        <option>-Select-</option>
                        <?php
                            // Include the database connection
                            include('connection.php');

                            // Query to fetch movie names from the database
                            $query = "select movie_id,movie_name from movies";
                            $query_run = mysqli_query($connection,$query);

                            // Check if query returned any results
                            if(mysqli_num_rows($query_run)){
                                // Loop through the query result and populate the dropdown options
                                while($row = mysqli_fetch_assoc($query_run)){
                                    ?>
                                    <!-- Display movie names as options -->
                                    <option id="<?php echo $row['movie_name']; ?>"><?php echo $row['movie_name']; ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select><br><br>

                    <!-- Submit button to move to the next step -->
                    <input type="submit" class="btn" style="background-color: white; color: black;" name="next" value="Next" id="next">
                </form>
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
