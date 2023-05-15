<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 20px;
      padding:20px;
    }

    .container {
      max-width: 500px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
    }

    form {
      margin-top: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-control {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-text {
      color: #6c757d;
      font-size: 12px;
    }

    .radio-group label {
      display: inline-block;
      margin-right: 15px;
    }

    .btn {
      display: block;
      width: 100%;
      padding: 10px;
      font-size: 16px;
      text-align: center;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #0069d9;
    }

    table {
      width: 600px;
      border-collapse: collapse;
      margin: 20px auto;
      background-color: #f2f2f2;
    }

    th, td {
      padding: 10px;
      border: 1px solid #000;
    }

    th {
      background-color: #007bff;
      color: #fff;
      text-align: left;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .my-div {
      width: 50%;
      height: 20%;
      background-color: #f2f2f2;
      border: solid #ccc;
      padding: 3%;
      text-align: center;
      float: left;
    }

    .students-list {
      width: 50%;
      height: 20%;
      background-color: #f2f2f2;
      border: solid #ccc;
      padding: 3%;
      text-align: center;
      float: left;
    }
  </style>
   
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) != TRUE) {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL
)";
if ($conn->query($sql) != TRUE) {
    echo "Error creating table: " . $conn->error . "<br>";
} 
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['status'] == "submit") {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$full_name', '$email', '$gender')";
  if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  } else {  
      echo "<h5>Student registration successful.</h1>";
  }
}

$conn->close();
?>
    <div class="my-div">
    <form action="?status=submit" method="post">
        <h3><p style="color: #007bff;">Student Registration Form</p></h1>
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" name="full_name" required>
        <small id="form-text text-muted" class="form-text text-muted">*Bu alan zorunlu</small>
    </div>

  <div class="form-group">
    <label >E-mail</label>
    <input type="email" class="form-control" name="email" required>
    <small id="form-text text-muted" class="form-text text-muted">*Bu alan zorunlu</small>
  </div>


  <div class="form-group">
    <label>Gender</label><br>
    <label><input type="radio" name="gender" value="Male" required> Male</label>
    <label><input type="radio" name="gender" value="Female"> Female</label>
</div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<div class="students-list">
<table>
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>E-mail</th>
      <th>Gender</th>
    </tr>

    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
    
    foreach ($result as $rs) {
        ?>
       <tr>
          <td> <?=$rs['id'] ?> </td>
          <td> <?=$rs['full_name'] ?> </td>
          <td> <?=$rs['email']?> </td>
          <td> <?=$rs['gender']?> </td>
        </tr>

    <?php   
    }
      $conn->close();
    ?>

  </table>
</div>


</body>
</html>