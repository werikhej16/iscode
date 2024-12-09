<?php
require 'config.php';

$doctorid = "";
$name = "";
$email = "";
$password = "";
$licenseid = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET method: Show the doctor data
    if (!isset($_GET["doctorid"])){
        header("location: /iscode/admin/index.php");
        exit;
    }
    $doctorid = $_GET['doctorid'];

    $sql = "SELECT * FROM doctor where doctorid=$doctorid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row){
        header("location: /iscode/admin/index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $password = $row["password"];
    $licenseid = $row["licenseid"];
}
else{
    //POST method: Update the doctor data

    $doctorid = $_POST["doctorid"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $licenseid = $_POST["licenseid"];

    do {
        if (empty($doctorid) || empty($name) || empty($email) || empty($password) || empty($licenseid) ){
            $errorMessage = "All the fields are required";
            break;
        }
        $sql = "UPDATE doctor".
               "SET name='$name', email='$email', password='$password', licenseid='$licenseid' ".
               "WHERE doctorid= $doctorid";

        $result = $conn->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }
        $successMessage = "Cient added successfully";

        header("location: /iscode/admin/index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthConnect</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Doctor</h2>

        <?php
        if ( !empty($errorMessage)) {
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> 
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="doctorid" value="<?php echo $doctorid; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" value="<?php echo $password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">LicenseId</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="licenseid" value="<?php echo $licenseid; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                   <div class='offset sm-3 col-sm-6'>
                       <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          <strong>$successMessage</strong>
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class= "col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="iscode/admin/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>