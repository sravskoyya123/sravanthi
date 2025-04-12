<?php

$conn = new mysqli("localhost", "root", "root", "certificate_validator");
session_start();
if (isset($_GET['id'])) {
    $_SESSION['course_id'] = $_GET['id'];
}
if ($_SESSION['course_id'] && $_SESSION['user_id']) {
    $course_id = $_SESSION['course_id'];
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT holder_name, course, completion_date FROM certification_details WHERE course_id='$course_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $sql2 = "SELECT company_name, company_logo FROM oraganization_details WHERE id='$user_id'";
    $result2 = mysqli_query($conn, $sql2);

    if (!$result2) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row2 = mysqli_fetch_assoc($result2);
    $holder_name = $row['holder_name'];
    $course_name = $row['course'];
    $completion_date = $row['completion_date'];
    $company_name = $row2['company_name'];
    $company_logo = $row2['company_logo'];
    $dateTime = new DateTime($completion_date);
    $holder_name = strtoupper($holder_name);
    $company_name = strtoupper($company_name);
    $Date = $dateTime->format("d-m-Y");
    $qrCodeURL = "http://api.qrserver.com/v1/create-qr-code/?data=http://localhost/project/verification/verification.php?id=$course_id&size=100x100";
    $qrCodeImage = file_get_contents($qrCodeURL);
    $qrCodeBase64 = base64_encode($qrCodeImage);
    $qrCodeDataUrl = 'data:image/png;base64,' . $qrCodeBase64;
} else {
    header("location: ../index.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <style>
        .b {
            position: relative;
            right: 50px;
            float: right;
        }

        .b:hover {
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="certificate.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<body>
    <a href="../logout.php" class="btn1 b">Logout</a>
    <div class="container pm-certificate-container" id="pdf-content" style="width: 815px; height: 615px">
        <div class="outer-border"></div>
        <div class="inner-border"></div>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($company_logo); ?>" class="i1" />
        <img src="<?php echo$qrCodeDataUrl;?>" class="i2" />
        <div class="pm-certificate-border col-xs-12">
            <div class="row pm-certificate-header">
                <div class="pm-certificate-title cursive col-xs-12 text-center">
                    <h2> Certificate of Completion</h2>
                </div>
            </div>

            <div class="row pm-certificate-body">
                <div class="pm-certificate-block">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-2"></div>
                            <div class="pm-certificate-name underline margin-0 col-xs-8 text-center">
                                <span class="pm-name-text bold"><?php echo $holder_name; ?> </span>
                            </div>
                            <div class="col-xs-2"></div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-2"></div>
                            <div class="pm-earned col-xs-8 text-center">
                                <span class="pm-earned-text padding-0 block cursive">Has Sucessful Completed</span>
                                <span class="pm-credits-text block bold sans">Crash couse on <?php echo $course_name; ?></span>
                            </div>
                            <div class="col-xs-2"></div>
                            <div class="col-xs-12"></div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-2"></div>
                            <div class="pm-course-title col-xs-8 text-center">
                                <span class="pm-earned-text block cursive">Offered through</span>
                            </div>
                            <div class="col-xs-2"></div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-2"></div>
                            <div class="pm-course-title underline col-xs-8 text-center">
                                <span class="pm-credits-text block bold sans"><?php echo $company_name; ?></span>
                            </div>
                            <div class="col-xs-2"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="row">
                        <div class="pm-certificate-footer">
                            <div class="col-xs-4 pm-certified col-xs-4 text-center">
                                <span class="pm-credits-text block sans"><br></span>
                                <span class="pm-empty-space block underline"></span>
                                <div class="date"><?php echo $Date; ?></div>
                                <span class="bold block">Date of Course Completion</span>

                            </div>
                            <div class="col-xs-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['v'])) {
        $url = "../view/index.php";
    } else {
        $url = "../register/index.php";
    }
    ?>
    <div class="btns">
        <button class="btn1" onclick="window.location.href = '<?php echo $url; ?>';">Back</button>
        <button class="btn1" id="download-pdf">Download</button>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script>
        document.getElementById("download-pdf").addEventListener("click", function() {
            const divToPrint = document.getElementById("pdf-content");
            const pdfOptions = {
                margin: 10,
                filename: "<?php echo$holder_name.$course_name;?>.pdf",
                image: {
                    type: "jpeg",
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: "mm",
                    format: "a4",
                    orientation: "landscape"
                }
            };

            html2pdf().from(divToPrint).set(pdfOptions).save();
        });
    </script>
</body>

</html>