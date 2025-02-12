<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dName = $_POST['petname'];
    $dBreed = $_POST['breed'];
    $dOwner = $_POST['owner'];

    $stmt = $conn->prepare("INSERT INTO tblreg (dName, dBreed, dOwner) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $dName, $dBreed, $dOwner);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "This script only handles POST requests.";
}
?>

<!-- Add a button to redirect to the home page -->
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <br><br>
    <button onclick="window.location.href='index.html'">Go to Home</button>
</body>
</html>