<?php
if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "FirstTask";

    // Connection Code
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM employee WHERE id=$id";
    $connection->query($sql);

}

header("location: /FirstTask/index.php");
exit;
?>