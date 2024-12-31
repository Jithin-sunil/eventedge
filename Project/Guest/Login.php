<?php
include('../Assets/Connection/Connection.php');
session_start();

if (isset($_POST['btn_submit'])) {
    $email = $_POST['txt_email'];
    $password = $_POST['txt_password'];
    
   
      $selqry = "SELECT * FROM tbl_student WHERE student_email='".$email."' AND student_password='".$password."'";
    $result = $con->query($selqry);
    
   
     $sel = "SELECT * FROM tbl_teacher WHERE teacher_email='".$email."' AND teacher_password='".$password."'";
    $res = $con->query($sel);
    
    
    $selq = "SELECT * FROM tbl_admin WHERE admin_email='".$email."' AND admin_password='$password'";
    $resul = $con->query($selq);
    
   
    if ($datastudent = $result->fetch_assoc()) 
    {
        $student_id = $datastudent["student_id"];
        $selqr = "SELECT * FROM tbl_coordinator WHERE student_id='$student_id'";
        $resu = $con->query($selqr);

        if ($data=$resu->fetch_assoc()) {
            $_SESSION["cid"] = $data['coordinator_id'];
            // echo "Cord:".$data['coordinator_id'];
            header('location:../Coordinator/Homepage.php');
        } else {
            
            $_SESSION["sid"] = $student_id;
            // echo "Student:".$student_id;
            header('location:../Student/Homepage.php');
        }
    } else if ($datateacher = $res->fetch_assoc()) {
        
         $_SESSION["tid"] = $datateacher["teacher_id"];
        header('location:../Teacher/Homepage.php');
    } else if ($dataadmin = $resul->fetch_assoc()) {
       
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Assets/Templates/Login/style.css">
    <title>LOGIN</title>
</head>

<body>

    <div class="container" id="container">
        
        <div class="form-container sign-in">
            <form method="post">
                <h1>Sign In</h1>
                
                <span>or use your email password</span>
                <input type="email" name="txt_email"  placeholder="Email" required>
                <input type="password" name="txt_password" placeholder="Password">
                
                <button type="submit" name="btn_submit">Sign In</button>
                <!-- <input type="submit" name="btn_submit" value="SignIN"> -->
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
               
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                  
                </div>
            </div>
        </div>
    </div>

    <script src="../Assets/Templates/Login/script.js"></script>
</body>

</html>
