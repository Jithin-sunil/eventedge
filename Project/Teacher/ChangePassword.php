<?php
include('../Assets/Connection/Connection.php');

include('Head.php');

if (isset($_POST['btn_submit'])) {
    $selqry = "select * from tbl_teacher where teacher_id='" . $_SESSION["tid"] . "'";
    $result = $con->query($selqry);
    $row = $result->fetch_assoc();
    $password = $row['teacher_password'];
    $teacheroldpassword = $_POST['txt_old_password'];
    $teachernewpassword = $_POST['txt_new_password'];
    $teacherretype = $_POST['txt_retype'];

    if ($password == $teacheroldpassword) {
        if ($teachernewpassword == $teacherretype) {
            $update = "update tbl_teacher set teacher_password='" . $teacherretype . "' where teacher_id='" . $_SESSION["tid"] . "'";
            if ($con->query($update)) {
                echo "
                <script>
                alert('Data Updated');
                window.location='ChangePassword.php';
                </script>";
            }
        } else {
            echo 'New password error';
        }
    } else {
        echo 'Old password error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
            padding: 30px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
<div class="container">
    <div class="form-container">
        <h2 class="text-center">Change Password</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="txt_old_password">Old Password</label>
                <input required type="password" class="form-control" name="txt_old_password" 
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters" 
                       id="txt_old_password" />
            </div>
            <div class="form-group">
                <label for="txt_new_password">New Password</label>
                <input required type="password" class="form-control" name="txt_new_password" 
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters" 
                       id="txt_new_password" />
            </div>
            <div class="form-group">
                <label for="txt_retype">Re-Type Password</label>
                <input required type="password" class="form-control" name="txt_retype" id="txt_retype" />
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" class="btn btn-primary">Change Password</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
include('Foot.php');
?>
