<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>HealthConnect Admin Dashboard</title>
</head>
<body>
    <div class="container my-5">
        <h2>List of Doctors</h2>
        <a class="btn btn-primary" href="create.php" role="button">New Doctor</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                <th>DoctorId</th>                    
                <th>Name</th>                    
                <th>Email</th>                    
                <th>Password</th>                    
                <th>LicenseId</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $port = "3306";
                $password = ""; // Replace with your MySQL password if necessary
                $dbname = "healthconnect";
                
                // Create a connection
                $conn = new mysqli($servername, $username, $password, $dbname,$port);
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM doctor";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }
                while($row = $result->fetch_assoc()){
                    echo"
                    <tr>
                      <td>$row[doctorid]</td>
                      <td>$row[name]</td>
                      <td>$row[email]</td>
                      <td>$row[password]</td>
                      <td>$row[licenseid]</td>
                     <td>
                        <a class='btn btn-primary btn-sm' href='edit.php?doctorid=$row[doctorid]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='delete.php?doctorid=$row[doctorid]'>Delete</a>
                     </td>
                    </tr>
                ";
                }
              
                ?>

            </tbody>
        </table>
    </div>
</body>
</html>