<?php
include('../Assets/Connection/Connection.php');

include('Head.php');

if (isset($_POST['btn_submit'])) {
    $selqry = "SELECT * FROM tbl_student WHERE student_id='" . $_SESSION["sid"] . "'";
    $result = $con->query($selqry);
    $row = $result->fetch_assoc();
    $password = $row['student_password'];
    $studentoldpassword = $_POST['txt_old_password'];
    $studentnewpassword = $_POST['txt_new_password'];
    $studentretype = $_POST['txt_retype'];

    if ($password == $studentoldpassword) {
        if ($studentnewpassword == $studentretype) {
            $update = "UPDATE tbl_student SET student_password='" . $studentretype . "' WHERE student_id='" . $_SESSION["sid"] . "'";
            if ($con->query($update)) {
                echo "
                <script>
                alert('Password Updated');
                window.location='ChangePassword.php';
                </script>";
            }
        } else {
            echo 'New password and re-typed password do not match.';
        }
    } else {
        echo 'Old password is incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .change-password-container {
            margin-top: 50px;
            max-width: 400px; /* Reduced max width */
            margin-left: auto;
            margin-right: auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container change-password-container">
        <div class="card">
            <div class="card-header text-center">
                <h4>Change Password</h4>
            </div>
            <div class="card-body">
                <form id="form1" name="form1" method="post" action="">
                    <div class="form-group">
                        <label for="txt_old_password">Old Password</label>
                        <input required type="password" name="txt_old_password" class="form-control"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                            id="txt_old_password" />
                    </div>
                    <div class="form-group">
                        <label for="txt_new_password">New Password</label>
                        <input required type="password" name="txt_new_password" class="form-control" 
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                            id="txt_new_password" />
                    </div>
                    <div class="form-group">
                        <label for="txt_retype">Re-Type Password</label>
                        <input required type="password" name="txt_retype" class="form-control" id="txt_retype" />
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Change Password</button>
                        <button type="reset" name="btn_cancel" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
include('Foot.php');
?>
