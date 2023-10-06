<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "FirstTask";

// Connection Code
$connection = new mysqli($servername, $username, $password, $database);


$Name = "";
$BirthDate = "";
$Nick_name = "";
$Address = "";
$Salary = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST["Name"];
    $BirthDate = $_POST["BirthDate"];
    $Nick_name = $_POST["Nick_name"];
    $Address = $_POST["Address"];
    $Salary = $_POST["Salary"];

    $errorMessage = "";
    $successMessage = "";

    do {
        if ( empty($Name) || empty($BirthDate) || empty($Nick_name) || empty($Address) || empty($Salary)) {
            $errorMessage = "All Fields are Required";
            break;
        }
        // Add new employee to the database
        $sql = "INSERT INTO employee (Name, BirthDate, Nick_name, Address, Salary)" .
        "VALUES ('$Name','$BirthDate','$Nick_name','$Address','$Salary')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

        $Name = "";
        $BirthDate = "";
        $Nick_name = "";
        $Address = "";
        $Salary = "";

        $successMessage = "Employee added successfully";

        header("location: /FirstTask/index.php");
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
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">First_Task</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/FirstTask/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <button class="btn btn-outline-success" type="submit">GitHub</button>
      </form>
    </div>
  </div>
</nav>
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