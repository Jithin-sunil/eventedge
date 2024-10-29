<?php
include('../Assets/Connection/Connection.php');
session_start();

if (isset($_POST['btn_submit'])) {
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];
    
    // Check if the user is a student
    $selqry = "SELECT * FROM tbl_student WHERE student_email='$email' AND student_password='$password'";
    $result = $con->query($selqry);
    
    // Check if the user is a teacher
    $sel = "SELECT * FROM tbl_teacher WHERE teacher_email='$email' AND teacher_password='$password'";
    $res = $con->query($sel);
    
    // Check if the user is an admin
    $selq = "SELECT * FROM tbl_admin WHERE admin_email='$email' AND admin_password='$password'";
    $resul = $con->query($selq);
    
    // If user is found as a student
    if ($datastudent = $result->fetch_assoc()) {
        $student_id = $datastudent["student_id"];
        
        // Check if the student is also a coordinator
        $selqr = "SELECT * FROM tbl_coordinator WHERE student_id='$student_id'";
        $resu = $con->query($selqr);

        if ($resu->fetch_assoc()) {
            // Log in as a coordinator if found in tbl_coordinator
            $_SESSION["cid"] = $student_id;
            header('location:../Coordinator/Homepage.php');
        } else {
            // Log in as a student if not found in tbl_coordinator
            $_SESSION["sid"] = $student_id;
            header('location:../Student/Homepage.php');
        }
    } else if ($datateacher = $res->fetch_assoc()) {
        // Log in as a teacher
        $_SESSION["tid"] = $datateacher["teacher_id"];
        header('location:../Teacher/Homepage.php');
    } else if ($dataadmin = $resul->fetch_assoc()) {
        // Log in as an admin
        $_SESSION["aid"] = $dataadmin["admin_id"];
        header('location:../Admin/Homepage.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form id="form1" name="form1" method="post" action="" class="login-container">
            <h2 class="text-center mb-4">Login</h2>
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input required type="email" name="txt_email" class="form-control" id="txt_email" />
            </div>
            <div class="form-group">
                <label for="txt_password">Password</label>
                <input required type="password" name="txt_password" class="form-control" id="txt_password" 
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" />
            </div>
            <div class="form-group text-center">
                <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Login" />
            </div>
        </form>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
