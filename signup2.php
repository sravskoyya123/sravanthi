<?php
/* $mysqli = new mysqli("localhost", "id21261098_root", "Sunny@123", "id21261098_root"); */
$mysqli = new mysqli("localhost", "root", "root", "certificate_validator");
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminName = $_POST["aname"];
    $companyName = $_POST["cname"];
    $companyRegistrationNo = $_POST["crgno"];
    $email = $_POST["email"];
    $phone_number = $_POST["ph_no"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    
    $sql = "INSERT INTO oraganization_details (admin_name, company_name, company_reg_no, email, phone_number, company_logo, password)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt === false) {
        die("Error: " . $mysqli->error);
    }
    
    $stmt->bind_param("sssssss", $adminName, $companyName, $companyRegistrationNo, $email, $phone_number, $imageData, $passwordHash);
    
    if ($stmt->execute()) {
        header("location: ./index.html");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
$mysqli->close();
?>
