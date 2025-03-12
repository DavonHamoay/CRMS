<?php
// Include the database configuration file to establish a connection
include('config.php');

// Check if the request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve data from the form
    $dName = $_POST['petname'];
    $dBreed = $_POST['breed'];
    $dFirstName = $_POST['firstName'];
    $dMiddleInitial = $_POST['middleInitial'];
    $dLastName = $_POST['lastName'];

    // Full owner name can be combined for storage or further use
    $dOwnerFullName = $dFirstName . ' ' . $dMiddleInitial . ' ' . $dLastName;

    // Prepare the SQL query to insert the data into the database
    $stmt = $conn->prepare("INSERT INTO tblreg (dName, dBreed, dOwner) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $dName, $dBreed, $dOwnerFullName); // Bind parameters to the query

    // Execute the query
    if ($stmt->execute()) {
        // If the insertion is successful, return a success message
        echo "Registration successful!";
    } else {
        // If there is an error, output the error
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If the request is not POST, return an error message
    echo "Invalid request method.";
}
?>
