<?php
include('config.php');

$PetName = $Breed = $Owner = $Vaccinated = $Status = "";
$isEdit = false; // Check if this is an edit action

// Check if editing
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $isEdit = true;

    // Fetch existing record
    $stmt = $conn->prepare("SELECT * FROM tblreg WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $PetName = $row['dName'];
        $Breed = $row['dBreed'];
        $Owner = $row['dOwner'];
        $Vaccinated = $row['dVaccinated'];
        $Status = $row['dStatus'];
    } else {
        echo "<script>alert('Record not found!'); window.location.href='table.php';</script>";
        exit();
    }
}

// Handle Form Submission (Insert or Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dName = $_POST['petname'];
    $dBreed = $_POST['breed'];
    $dOwner = $_POST['owner'];
    $vaccinated = $_POST['vaccinated'];
    $status = $_POST['status'];

    if ($isEdit) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE tblreg SET dName = ?, dBreed = ?, dOwner = ?, dVaccinated = ?, dStatus = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $dName, $dBreed, $dOwner, $vaccinated, $status, $id);
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO tblreg (dName, dBreed, dOwner, dVaccinated, dStatus) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $dName, $dBreed, $dOwner, $vaccinated, $status);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Operation successful!'); window.location.href='table.php';</script>";
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
    <title><?php echo $isEdit ? "Edit Pet" : "Register Pet"; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2><?php echo $isEdit ? "Edit Pet Information" : "Register Your Pet"; ?></h2>
    <form action="" method="POST" class="mt-3">
        <div class="mb-3">
            <label for="petname" class="form-label">Pet Name:</label>
            <input type="text" id="petname" name="petname" class="form-control" required placeholder="Enter pet's name" value="<?php echo htmlspecialchars($PetName); ?>">
        </div>
        <div class="mb-3">
            <label for="breed" class="form-label">Breed:</label>
            <input type="text" id="breed" name="breed" class="form-control" required placeholder="Enter breed" value="<?php echo htmlspecialchars($Breed); ?>">
        </div>
        <div class="mb-3">
            <label for="owner" class="form-label">Owner:</label>
            <input type="text" id="owner" name="owner" class="form-control" required placeholder="Enter owner's name" value="<?php echo htmlspecialchars($Owner); ?>">
        </div>

        <!-- Vaccination Status -->
        <div class="mb-3">
            <label class="form-label">Vaccination Status:</label><br>
            <input type="radio" id="vaccinated_yes" name="vaccinated" value="Yes" required <?php echo ($Vaccinated == "Yes") ? "checked" : ""; ?>>
            <label for="vaccinated_yes">Yes</label>
            <input type="radio" id="vaccinated_no" name="vaccinated" value="No" required <?php echo ($Vaccinated == "No") ? "checked" : ""; ?>>
            <label for="vaccinated_no">No</label>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status:</label><br>
            <input type="radio" id="available" name="status" value="Available" required <?php echo ($Status == "Available") ? "checked" : ""; ?>>
            <label for="available">Available</label>
            <input type="radio" id="adopted" name="status" value="Adopted" required <?php echo ($Status == "Adopted") ? "checked" : ""; ?>>
            <label for="adopted">Adopted</label>
        </div>

        <button type="submit" class="btn btn-primary"><?php echo $isEdit ? "Update" : "Register"; ?></button>
        <a href="table.php" class="btn btn-secondary">View Registered Pets</a>
    </form>
</div>
</body>
</html>
