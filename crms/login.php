<?php
// Include the database connection file
include 'config.php';

// Start the session for maintaining user login state
session_start();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement using a question mark placeholder
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get the result of the query
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Debugging: Print out user data for verification (remove in production)
    if ($user) {
        echo "User found: " . htmlspecialchars($user['username']) . "<br>";
        echo "Stored hash: " . htmlspecialchars($user['password_hash']) . "<br>";
    } else {
        echo "No user found with that username.<br>";
    }

    // Verify the password if a user is found
    if ($user && password_verify($password, $user['password_hash'])) {
        // Set session variable for the logged-in user
        $_SESSION['username'] = $username;

        // Redirect to dashboard.html
        header('Location: home.html');
        exit();
    } else {
        // Authentication failed
        echo "Invalid username or password.";
    }

    // Close the statement
    $stmt->close();
}
?>
