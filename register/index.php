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
            background-color: #fff;
            border: none;
            color: #000;
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
             right: -1000px; 
        }

        .b1 {
            position: relative;
            background-color: #fff;
            left: -300px;
        }
        .b:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="btn2">
        <a href="../home/index.php" class="btn1 b1">Back</a>
        <a href="../logout.php" class="btn1 b">Logout</a>
    </div>
    <section class="container">
        <header>Cerificate Registration Form</header>
        <form action="certificate_reg.php" method="post" class="form">
            <div class="input-box">
                <label>Certificate Holder Name</label>
                <input type="text" name="name" placeholder="Enter full name" required />
            </div>
            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" value="MALE" checked />
                        <label for="check-male">MALE</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="FEMALE" />
                        <label for="check-female">FEMALE</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-other" name="gender" value="PREFER NOT TO SAY" />
                        <label for="check-other">PREFER NOT TO SAY</label>
                    </div>
                </div>
            </div>
            <div class="input-box">
                <label>Course Name</label>
                <input type="text" name="cname" placeholder="Enter Course Name" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Course Completion Date</label>
                    <input type="date" name="cdate" placeholder="Enter Course completion date" required />
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>

</html>