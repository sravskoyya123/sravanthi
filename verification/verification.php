<?php
$conn = new mysqli("localhost", "root", "root", "certificate_validator");
session_start();

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
}

$sql = "SELECT holder_name, course, completion_date FROM certification_details WHERE course_id='$course_id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if there are rows in the result set
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $holder_name = $row['holder_name'];
    $course_name = $row['course'];
    $completion_date = $row['completion_date'];
    $dateTime = new DateTime($completion_date);
    $holder_name = strtoupper($holder_name);
    $Date = $dateTime->format("d-m-Y");
} else {
    // No data found, set default values or display a message
    $holder_name = "No Data Found";
    $course_name = "No Data Found";
    $Date = "No Data Found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            min-width: 600px;
            min-height: 400px;
        }

        h3 {
            margin-top: 20px;
            color: #009900;
        }

        .con {
            margin: 50px;
        }

        .input-box {
            margin: 10px 0;
        }

        label {
            font-weight: bold;
            display: flex;
        }

        p {
            margin: 10px 10px 10px 100px;
            display: flex;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #009900;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        a:hover {
            background-color: #007700;
        }
    </style>
</head>

<body>
    <section class="container"><!-- 
        <h3>Your Certificate Verification Result</h3> -->
        <h3>Your Certificate Successfully Verified</h3>
        <div class="con">
            <div class="input-box">
                <label><b>Certificate Holder Name:</b></label>
                <p><?php echo $holder_name; ?></p>
            </div>
            <div class="input-box">
                <label><b>Course Name:</b></label>
                <p><?php echo $course_name; ?></p>
            </div>
            <div class="input-box">
                <label><b>Course Completion Date:</b></label>
                <p><?php echo $Date; ?></p>
            </div>
        </div>
    </section>
</body>

</html>
