<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "FirstTask";

// Connection Code
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$Name = "";
$BirthDate = "";
$Nick_name = "";
$Address = "";
$Salary = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    if( !isset($_GET["id"])){
        header("location: /FirstTask/index.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM employee WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header("location: /FirstTask/index.php");
        exit;
    }
    $Name = $row["Name"];
    $BirthDate = $row["Birthdate"];
    $Nick_name = $row["Nick_name"];
    $Address = $row["Address"];
    $Salary = $row["Salary"];
}
else{
    // post method for update data
    $id = $_POST["id"];
    $Name = $_POST["Name"];
    $BirthDate = $_POST["BirthDate"];
    $Nick_name = $_POST["Nick_name"];
    $Address = $_POST["Address"];
    $Salary = $_POST["Salary"];

    do{
        if ( empty($id) || empty($Name) || empty($BirthDate) || empty($Nick_name) || empty($Address) || empty($Salary)) {
            $errorMessage = "All Fields are Required";
            break;
        }
        $sql = "UPDATE employee " .
            "SET Name = '$Name', BirthDate= '$BirthDate', Nick_name= '$Nick_name', Address='$Address', Salary='$Salary'" .
            "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }
        $successMessage = "Employee dded successfully";

        header("location: /FirstTask /index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FirstTask</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container my-3">
    <h2>Add New Employee</h2>

    <?php
    if ( !empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>$errorMessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
    </div>
        ";
    }
    ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Name" value="<?php echo $Name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">BirthDate</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="BirthDate" value="<?php echo $BirthDate; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nick_name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Nick_name" value="<?php echo $Nick_name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Address" value="<?php echo $Address; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Salary</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Salary" value="<?php echo $Salary; ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
        
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            <div class="offset-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/FirstTask/index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>