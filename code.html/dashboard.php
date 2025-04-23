<?php
// Database connection details
$servername = "localhost";
$username = "aimlg06";
$password = "aimlg06";
$database = "aimlg06";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve updated attendance data
$sql = "SELECT usn, photo, fname, dept, attendance, updated_at FROM students";
$result = $conn->query($sql);

// Output the data in HTML for AJAX update
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["usn"]."</td>";
        echo "<td><img src='".$row["photo"]."' alt='Student Photo' style='width: 100px;'></td>";
        echo "<td>".$row["fname"]."</td>";
        echo "<td>".$row["dept"]."</td>";
        echo "<td>".$row["attendance"]."</td>";
        echo "<td>".$row["updated_at"]."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

// Close connection
$conn->close();
?>
