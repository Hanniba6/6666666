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

// Retrieve the JSON data sent from the client (front-end)
$data = file_get_contents('php://input');
$classes = json_decode($data, true); // Decode the JSON data into a PHP array

// Prepare SQL statement to insert data into the timetable table
$stmt = $conn->prepare("INSERT INTO timetable (subject, day, time, teacher) VALUES (?, ?, ?, ?)");

// Loop through each class and insert it into the database
foreach ($classes as $class) {
    $subject = $class['subject'];
    $day = $class['day'];
    $time = $class['time'];
    $teacher = $class['teacher']; // Get teacher's name from the incoming data

    // Bind the parameters and execute the query
    $stmt->bind_param("ssss", $subject, $day, $time, $teacher);
    $stmt->execute(); // Execute the SQL statement
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Return a success response to the client
echo json_encode(["status" => "success"]);
?>
