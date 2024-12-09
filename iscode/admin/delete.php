<?php
if (isset ($_GET["doctorid"])){
    $doctorid = $_GET['doctorid'];

    require 'config.php';

    $sql = "DELETE FROM doctor WHERE doctorid=$doctorid";
    $result = $conn->query($sql);
}

header("location: /iscode/admin/index.php");
exit;
?>