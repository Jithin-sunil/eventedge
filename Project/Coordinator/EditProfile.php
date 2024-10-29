<?php
include('../Assets/Connection/Connection.php');

include('Head.php');

$selqry = "SELECT * FROM tbl_coordinator c INNER JOIN  tbl_student s on c.student_id=s.student_id WHERE c.coordinator_id='" . $_SESSION["cid"] . "'";
$result = $con->query($selqry);
$row = $result->fetch_assoc();
$student=$row['student_id'];

if (isset($_POST['btn_submit'])) {
    $studentname = $_POST['txt_name'];
    $studentemail = $_POST['txt_email'];
    $studentcontact = $_POST['txt_contact'];
    $update = "UPDATE tbl_student SET student_name='" . $studentname . "', student_email='" . $studentemail . "', student_contact='" . $studentcontact . "' WHERE student_id='" . $student. "'";
    if ($con->query($update)) {
        echo "
        <script>
        alert('Data Updated');
        window.location='MyProfile.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-container {
            margin-top: 50px;
            max-width: 400px; /* Reduced max width */
            margin-left: auto;
            margin-right: auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            font-size: 0.9rem; /* Reduced font size for form inputs */
        }
    </style>
</head>

<body>
    <div class="container profile-container">
        <div class="card">
            <div class="card-header text-center">
                <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="txt_name">Name</label>
                        <input required type="text" name="txt_name" class="form-control" 
                            title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" 
                            pattern="^[A-Z]+[a-zA-Z ]*$" 
                            id="txt_name" value="<?php echo $row['student_name']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="txt_email">Email</label>
                        <input required type="email" name="txt_email" class="form-control" 
                            id="txt_email" value="<?php echo $row['student_email']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="txt_contact">Contact</label>
                        <input required type="text" name="txt_contact" class="form-control" 
                            pattern="[7-9]{1}[0-9]{9}" 
                            title="Phone number with 7-9 and remaining 9 digits with 0-9" 
                            id="txt_contact" value="<?php echo $row['student_contact']; ?>" />
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Edit</button>
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
