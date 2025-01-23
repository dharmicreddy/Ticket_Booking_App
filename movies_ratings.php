<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; //  database username
$password = ""; //  database password
$dbname = "movie_database"; // Database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection and handle connection failure
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Terminate if connection fails
}

// SQL query to find users who have made multiple bookings on the same day, including the movie name
$sql = "
    SELECT b1.booking_user_id, b1.booking_time, b1.booking_movie_name
    FROM booking b1
    WHERE EXISTS (
        SELECT 1
        FROM booking b2
        WHERE b2.booking_user_id = b1.booking_user_id
        AND DATE(b2.booking_time) = DATE(b1.booking_time)
        AND b2.booking_id != b1.booking_id
    );
";

// Execute the query and store the result
$result = $conn->query($sql);

// Handle the case where the query fails
if (!$result) {
    die("Query failed: " . $conn->error); // Display error if query execution fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Bookings Analysis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Users with Multiple Bookings on the Same Day</h1>

    <?php
    // Check if the query returned any results
    if ($result && $result->num_rows > 0) {
        // Display the results in a table format
        echo "<table>";
        echo "<tr><th>User ID</th><th>Booking Time</th><th>Movie Name</th></tr>";
        // Output data of each row in the result
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row['booking_user_id']) . "</td><td>" . htmlspecialchars($row['booking_time']) . "</td><td>" . htmlspecialchars($row['booking_movie_name']) . "</td></tr>";
        }
        echo "</table>";
    } else {
        // If no results found, display a message
        echo "<p style='text-align: center;'>No users found with multiple bookings on the same day.</p>";
    }
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
