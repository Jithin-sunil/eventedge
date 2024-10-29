<?php
include('../Assets/Connection/Connection.php');

include('Head.php');

$selqry = "SELECT * FROM tbl_student s 
           INNER JOIN tbl_course c ON s.course_id = c.course_id 
           INNER JOIN tbl_department d ON c.department_id = d.department_id 
           WHERE s.student_id='" . $_SESSION["sid"] . "'";

$result = $con->query($selqry);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-container {
            margin-top: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        .profile-header h2 {
            font-size: 24px;
            font-weight: bold;
        }
        .profile-photo {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile-table {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 15px;
        }
        .btn-group {
            display: flex;
            justify-content: space-around;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container profile-container">
        <div class="profile-header text-center">
            <h2>My Profile</h2>
        </div>
        <div class="card profile-table">
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr class="text-center">
                        <td colspan="2">
                            <img src="../Assets/Files/Student/<?php echo $row['student_photo']; ?>" 
                                 class="profile-photo" alt="Profile Photo" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?php echo $row['student_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo $row['student_email']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact:</strong></td>
                        <td><?php echo $row['student_contact']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Department:</strong></td>
                        <td><?php echo $row['department_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Course:</strong></td>
                        <td><?php echo $row['course_name']; ?></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="2" class="btn-group">
                            <a href="EditProfile.php" class="btn btn-primary btn-sm">Edit Profile</a>
                            <a href="ChangePassword.php" class="btn btn-secondary btn-sm">Change Password</a>
                        </td>
                    </tr>
                </table>
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
