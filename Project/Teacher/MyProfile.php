<?php
include('../Assets/Connection/Connection.php');

include('Head.php');
$selqry = "SELECT * FROM tbl_teacher t INNER JOIN tbl_department d ON t.department_id = d.department_id WHERE t.teacher_id = '".$_SESSION["tid"]."'";
$result = $con->query($selqry);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-container {
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn-custom {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container profile-container">
        <h2 class="text-center mb-4">My Profile</h2>
        <div class="text-center mb-4">
            <img src="../Assets/Files/Teacher/<?php echo $row['teacher_photo']; ?>" class="profile-image" alt="Profile Photo">
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><?php echo $row['teacher_name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['teacher_email']; ?></td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><?php echo $row['teacher_contact']; ?></td>
            </tr>
            <tr>
                <th>Department</th>
                <td><?php echo $row['department_name']; ?></td>
            </tr>
        </table>
        <div class="text-center">
            <a href="EditProfile.php" class="btn btn-primary btn-primary">Edit Profile</a>
            <a href="ChangePassword.php" class="btn btn-secondary">Change Password</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
include('Foot.php');
?>
