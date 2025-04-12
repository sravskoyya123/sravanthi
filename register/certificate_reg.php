<?php
$mysqli = new mysqli("localhost", "root", "root", "certificate_validator");
session_start();
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $holderName = $_POST["name"];
    $courseName = $_POST["cname"];
    $gender = $_POST["gender"];
    $cdate = $_POST["cdate"];
    if ($gender == "MALE") {
        $holderName = "Mr. " . $holderName;
    } else if ($gender == "FEMALE") {
        $holderName = "Mrs. " . $holderName;
    } else {
        $holderName = "Mr/Mrs. " . $holderName;
    }
    echo $holderName . " " . $courseName . " " . $gender . " " . $cdate;
    $sql = "INSERT INTO certification_details (holder_name , course, completion_date,id)
            VALUES (?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("sssi", $holderName, $courseName, $cdate,$_SESSION['user_id']);
    if ($stmt->execute()) {
        $sql2 = "SELECT course_id From certification_details WHERE holder_name=? AND course=? AND completion_date=?;";
        $stmt2 = $mysqli->prepare($sql2);
        if ($stmt2 === false) {
            die("Error: " . $mysqli->error);
        }

        $stmt2->bind_param("sss", $holderName, $courseName, $cdate);
        $stmt2->execute();
        $stmt2->bind_result($id);
        $stmt2->fetch();
        $_SESSION['course_id'] = $id;
        if ($_SESSION['course_id']) {
            header("location: ../certificate/certificate.php");
        }
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "dfsghds";
}

$mysqli->close();
