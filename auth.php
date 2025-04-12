<?php
session_start();
$mysqli = new mysqli("localhost", "root", "root", "certificate_validator");

if (!$mysqli) {
    echo "Database connection failed!";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM oraganization_details WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt === false) {
        die("Error: " . $mysqli->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $row["id"];
            if($_SESSION['user_id']){
            header("location: ./home/index.php");
            }
            exit;
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please register or check your email.";
    }
    $stmt->close();
    $mysqli->close();
}

?>
