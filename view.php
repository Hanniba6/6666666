<?php
// Database configuration - change these values to your own settings
$servername = "sql310.infinityfree.com";
$username = "if0_37529231";  // Change to your database username
$password = "SRMy0aASlJ5tV";    // Change to your database password
$dbname = "if0_37529231_hanniba";     // Change to your database name

// Create connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch timetable data from the database
$sql = "SELECT * FROM timetable";
$result = $conn->query($sql);

// Display timetable in a table format
echo "<h1>Timetable</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Day</th>
            <th>Time</th>
            <th>Teacher</th>
        </tr>";

if ($result->num_rows > 0) {
    // Output data of each row and display in a table row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["subject"] . "</td>
                <td>" . $row["day"] . "</td>
                <td>" . $row["time"] . "</td>
                <td>" . $row["teacher"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";  // If no data found in the table
}

$conn->close();  // Close the database connection
?>
