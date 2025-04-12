<?php
session_start();
if (!$_SESSION['user_id']) {
    header("location: ../index.html");
}
$user_id=$_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="style1.css" />
    <style>
        .btn1 {
            background-color: #59555596;
            border: none;
            color: #000;
            width: 200px;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn2 {
            position: relative;
            display: flex;
            top: -400px;
        }

        .b {
            position: relative;
            background-color: #fff;
            right: -900px;
        }

        .b:hover {
            text-decoration: none;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .b1 {
            position: relative;
            background-color: #fff;
            left: -400px;
        }
        .p{
            text-decoration: none;
            cursor: pointer;
            color: #000;
        }
        .p:hover{
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="btn2">
        <a href="../home/index.php" class="btn1 b1">Back</a>
        <a href="../logout.php" class="btn1 b">Logout</a>
    </div>
    <section class="container">
        <h3>Certificates</h3>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Course Name</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mysqli = new mysqli("localhost", "root", "root", "certificate_validator");

                if ($mysqli->connect_error) {
                    die("Database connection failed: " . $mysqli->connect_error);
                }

                $sql = "SELECT course_id,holder_name,course FROM certification_details WHERE id='$user_id'";
                $result = $mysqli->query($sql);
                $temp = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $temp . "</td>";
                        echo "<td>" . $row["holder_name"] . "</td>";
                        echo "<td>" . $row["course"] . "</td>";
                        echo "<td> <a class='p' href='../certificate/certificate.php?id=".$row["course_id"]."&v'>View Certificate</a> </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No data available</td></tr>";
                }

                $mysqli->close();
                ?>

            </tbody>
        </table>
    </section>
</body>

</html>