<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MYSQL - CRUD</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
<section class="my-5">
    <div class="container">
        <h2 class="text-center mb-4">Pet Registration Records</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Dog Name</th>
                        <th scope="col">Dog Breed</th>
                        <th scope="col">Owner Name</th>
                        <th scope="col">Vaccination Status</th>
                        <th scope="col">Status</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once "config.php";
                        $sql_query = "SELECT * FROM tblreg";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) { 
                                $Id = $row['id']; // Assuming your table has a primary key 'id'
                                $PetName = htmlspecialchars($row['dName'] ?? 'N/A');
                                $Breed = htmlspecialchars($row['dBreed'] ?? 'N/A');
                                $Owner = htmlspecialchars($row['dOwner'] ?? 'N/A');
                                $Vacc = htmlspecialchars($row['dVaccinated'] ?? 'N/A');
                                $Status = htmlspecialchars($row['dStatus'] ?? 'N/A');
                    ?>
                    <tr>
                        <td><?php echo $PetName; ?></td>
                        <td><?php echo $Breed; ?></td>
                        <td><?php echo $Owner; ?></td>
                        <td><?php echo ($Vacc == 'Yes') ? "✅ Yes" : "❌ No"; ?></td>
                        <td><?php echo ($Status == 'Available') ? "<span class='text-success'>🟢 Available</span>" : "<span class='text-danger'>🔴 Adopted</span>"; ?></td>
                        <td><a href="editdata.php?id=<?php echo $Id; ?>" class="btn btn-warning btn-sm">Edit</a></td>
                        <td><a href="deletedata.php?id=<?php echo $Id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                    </tr>
                    <?php
                            } 
                        } else {
                            echo "<tr><td colspan='7'>No records found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Button to go back to home -->
<div class="text-center my-4">
    <button class="btn btn-primary" onclick="window.location.href='index.html'">Go to Home</button>
</div>

</body>
</html>
