<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dName = $_POST['petname'];
    $dBreed = $_POST['breed'];
    $dOwner = $_POST['owner'];

    $stmt = $conn->prepare("INSERT INTO tblreg (dName, dBreed, dOwner) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $dName, $dBreed, $dOwner);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pet</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Register Your Pet</h2>
    <form action="register.php" method="POST" class="mt-3">
        <div class="mb-3">
            <label for="petname" class="form-label">Pet Name:</label>
            <input type="text" id="petname" name="petname" class="form-control" required placeholder="Enter pet's name">
        </div>
        <div class="mb-3">
            <label for="breed" class="form-label">Breed:</label>
            <input type="text" id="breed" name="breed" class="form-control" required placeholder="Enter breed">
        </div>
        <div class="mb-3">
            <label for="owner" class="form-label">Owner:</label>
            <input type="text" id="owner" name="owner" class="form-control" required placeholder="Enter owner's name">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>
