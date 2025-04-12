<?php
session_start();
if (!$_SESSION['user_id']) {
    header("location: ../index.html");
}
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

        .b {
            position: relative;
            right: -850px;
            /* float: right; */
            top: -420px;
            background-color: #fff;
        }

        .b:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <a href="../logout.php" class="btn1 b">Logout</a>
    <section class="container">
        <a href="../register/index.php"class="btn1">certificate registration</a><br><br><br>
        <a href="../view/index.php"class="btn1">Generated certificates </a>
    </section>
</body>

</html>