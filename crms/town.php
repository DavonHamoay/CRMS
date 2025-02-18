<?php 
require_once "config.php";

// Modify the query to join the tblreg table with the towns table
$sql_query = "SELECT t.dTown, 
                     COUNT(*) AS dog_count, 
                     SUM(CASE WHEN r.dVaccinated = 'Yes' THEN 1 ELSE 0 END) AS vaccinated_count
              FROM tblreg r
              JOIN towns t ON r.dTownID = t.id
              GROUP BY t.dTown";

if ($result = $conn->query($sql_query)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Canines by Town</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (including Popper for tooltips and modals) -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Registered Canines by Town</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Barangay</th>
                        <th scope="col">Number of Registered Dogs</th>
                        <th scope="col">Vaccinated Dogs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($row = $result->fetch_assoc()) { 
                        $Town = htmlspecialchars($row['dTown'] ?? 'Unknown');
                        $DogCount = htmlspecialchars($row['dog_count'] ?? '0');
                        $VaccinatedCount = htmlspecialchars($row['vaccinated_count'] ?? '0');
                    ?>
                    <tr>
                        <td><a href="town_detail.php?town=<?php echo urlencode($Town); ?>"><?php echo $Town; ?></a></td>
                        <td><?php echo $DogCount; ?></td>
                        <td><?php echo $VaccinatedCount; ?></td>
                    </tr>
                    <?php
                    } 
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <a href="home.html" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</body>
</html>
<?php
} 
?>
