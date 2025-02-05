<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO crud (crud_uname, crud_pword, crud_email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $pass, $email);

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