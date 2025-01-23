<?php 
    // Start the session to access session variables
    session_start();

    // Handle profile update
    if(isset($_POST['update'])){
        include('connection.php');
        
        // SQL query to update user profile based on email from session
        $query = "update users set user_name = '$_POST[name]', user_email = '$_POST[email]', user_mobile = $_POST[mobile] where user_email = '$_SESSION[email]'";
        
        // Execute the query and store the result
        $query_run = mysqli_query($connection,$query);
        
        // If query runs successfully, show success message
        if($query_run){
            echo "<script type='text/javascript'>
                alert('Profile updated successfully....');
                window.location.href = 'user_dashboard.php';  
            </script>";
        }
        else{
            // If query fails, show error message
            echo "<script type='text/javascript'>
                alert('Error...Plz try again.');
                window.location.href = 'user_dashboard.php';
            </script>";
        }
    }

    // Handle password change
    if(isset($_POST['change_password'])){
        include('connection.php');
        
        // SQL query to fetch the current password of the user
        $query1 = "select user_password from users where user_email = '$_SESSION[email]'";
        $query_run1 = mysqli_query($connection,$query1);
        
        $current_password = "";
        // Fetch current password from the database
        while($row = mysqli_fetch_assoc($query_run1)){
            $current_password = $row['user_password'];  
        }

        // Check if the entered current password matches and the new passwords are identical
        if(($current_password == $_POST['newPassword1']) && ($_POST['newPassword1'] == $_POST['newPassword2'])){
            // If passwords match, update the password in the database
            $query = "update users set user_password = '$_POST[newPassword]' where user_email = '$_SESSION[email]'";
            $query_run = mysqli_query($connection,$query);
            
            // If query runs successfully, show success message
            if($query_run){
                echo "<script type='text/javascript'>
                    alert('Password changed successfully....');
                    window.location.href = 'user_dashboard.php';  
                </script>";
            }
            else{
                // If query fails, show error message
                echo "<script type='text/javascript'>
                    alert('Password mismatch or wrong current password!');
                    window.location.href = 'user_dashboard.php';
                </script>";
            }
        }
    }
?>

<?php 
    // Check if the user is logged in (session variable 'email' is set)
    if(isset($_SESSION['email'])){
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Dashboard</title>
    
    <!-- Bootstrap CSS for styling -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></link>
		
		<!-- Bootstrap JS for functionality -->
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Custom CSS for additional styling -->
		<link rel="stylesheet" href="css/style.css">
    
    <!-- jQuery for dynamic content loading -->
    <script type="text/javascript" src="jquery/jquery_latest.js"></script>

    <script type="text/javascript">
      // jQuery functions to load content dynamically into the "load_section" div
      $(document).ready(function(){
        $("#view_profile").click(function(){
          $("#load_section").load("viewProfile.php");
        });

        $("#change_password").click(function(){
          $("#load_section").load("changePassword.php");
        });

        $("#book_ticket").click(function(){
          $("#load_section").load("SelectMovie.php");
        });

        $("#view_ticket").click(function(){
          $("#load_section").load("viewTicket.php");
        });

        $("#cancel_ticket").click(function(){
          $("#load_section").load("cancelTicket.php");
        });
      });
    </script>
  </head>
  <body style="overflow-x: hidden; background-color:white;">
    <!-- Header section with user email and name -->
    <div class="row" id="header">
      <div class="col-md-4">
        <h4 style="padding-left:15px;font-family:'Ariel';">MovieBooking</h4>
      </div>
      <div class="col-md-7" style="text-align: right;">
        <span style="padding-right:75px;"><?php echo "Email: " . $_SESSION['email'];?></span>
        <span><?php echo "Welcome: " . $_SESSION['name'];?></span>
      </div>
    </div>
    
    <!-- Main content with navigation options on the left -->
    <div class="row" style="margin:25px;">
      <div class="col-md-2" style="border-right:1px solid black;">
        <!-- Navigation links to view and manage user profile, tickets, etc. -->
        <a class="btn btn-block" id="view_profile" style="background-color: black; color: white;">View Profile</a><br>
        <a class="btn btn-block" id="change_password" style="background-color: black; color: white;">Reset Password</a><br>
        <a class="btn btn-block" id="book_ticket" style="background-color: black; color: white;">Book Ticket</a><br>
        <a class="btn btn-block" id="view_ticket" style="background-color: black; color: white;">View Ticket</a><br>
        <a class="btn btn-block" id="cancel_ticket" style="background-color: black; color: white;">Cancel Ticket</a><br>
        <a class="btn btn-block" href="logout.php" style="background-color: black; color: white;">Logout</a><br>
      </div>

      <!-- Main section to dynamically load content -->
      <div class="col-md-8" id="load_section" style="background-color: black;padding:25px;">
        <p style="color:white;">USER INFORMATION</p>
      </div>
      <div class="col-md-2"></div>
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
