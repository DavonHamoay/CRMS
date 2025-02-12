<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MYSQL - CRUD</title>
    <!-- CSS only -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
<section style="margin: 50px 0;">
        <div class="container">
            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">Dog Name</th>
                    <th scope="col">Dog Breed</th>
                    <th scope="col">Owner Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once "config.php";
                        $sql_query = "SELECT * FROM tblreg";
                        if ($result = $conn ->query($sql_query)) {
                            while ($row = $result -> fetch_assoc()) { 
                                $PetName = $row['dName'];
                                $Breed = $row['dBreed'];
                                $Owner = $row['dOwner'];
                    ?>
                    
                    <tr class="trow">
                        <td><?php echo $PetName; ?></td>
                        <td><?php echo $Breed; ?></td>
                        <td><?php echo $Owner; ?></td>
                        <td><a href="deletedata.php?id=<?php echo $Id; ?>" class="btn btn-danger">Delete</a></td>
                    </tr>

                    <?php
                            } 
                        } 
                    ?>
                </tbody>
              </table>
        </div>
    </section>
</body>

<!-- Add a button to redirect to the home page -->
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <br><br>
    <button onclick="window.location.href='dashboard.html'">Go to Home</button>
</body>
</html>