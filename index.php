<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FirstTask</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
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
<div class="container my-2">
    <h2>list of Employee</h2>
    <a class="btn btn-primary" href="/FirstTask/create.php" role="button">New Employee</a>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>BirthDate</th>
                <th>Nick_name</th>
                <th>Address</th>
                <th>Salary</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "FirstTask";

            // Connection Code
            $connection = new mysqli($servername, $username, $password, $database);

            // Connection Code
            if ($connection->connect_error)
            {
                die("Connection failed: " . $connection->connect_error);
            }

            // read data from database table
            $sql = "SELECT * FROM employee";
            $result = $connection->query($sql);

            if (!$result) {
                die("invlid query: " . $connection->error);
            }

            while($row = $result->fetch_assoc()){
                 echo "
                 <tr>
                    <td>$row[id]</td>
                    <td>$row[Name]</td>
                    <td>$row[BirthDate]</td>
                    <td>$row[Nick_name]</td>
                    <td>$row[Address]</td>
                    <td>$row[Salary]</td>
                    <td>
                        <a class='btn btn-primary' href='/FirstTask/Update.php?id=$row[id]'>Update</a>
                        <a class='btn btn-danger' href='/FirstTask/Delete.php?id=$row[id]'>Delete</a>
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