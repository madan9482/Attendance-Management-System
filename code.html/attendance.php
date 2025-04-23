<?php
// Check if POST request is made
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the JSON payload from the request
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Make sure qrData exists
    if (isset($data['qrData'])) {
        $qrData = $data['qrData'];

        // Your database connection details
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

        // Update attendance query
        // Assuming `attendance` is a field that you update for attendance status (1 for present, 0 for absent)
        $stmt = $conn->prepare("UPDATE students SET attendance = 1 WHERE usn = ?");
        $stmt->bind_param("s", $qrData); // Assuming QR code contains the student's USN

        // Execute the query
        if ($stmt->execute()) {
            echo "Attendance marked for USN: " . $qrData;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "No QR data received.";
    }
}
?>
