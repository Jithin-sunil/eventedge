<?php
include('../Assets/Connection/Connection.php');

include('Head.php');
$selqry="select * from tbl_teacher where teacher_id='".$_SESSION["tid"]."'";
$result=$con->query($selqry);
$row=$result->fetch_assoc();

if(isset($_POST['btn_submit'])) {
    $teachername=$_POST['txt_name'];
    $teacheremail=$_POST['txt_email'];
    $teachercontact=$_POST['txt_contact'];
    $update="update tbl_teacher set teacher_name='".$teachername."', teacher_email='".$teacheremail."', teacher_contact='".$teachercontact."' where teacher_id='".$_SESSION["tid"]."'";

    if($con->query($update)) {
        echo "
        <script>
        alert('Data Updated');
        window.location='EditProfile.php';
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
            padding: 20px; /* Reduced padding */
            max-width: 400px; /* Set max width for the form */
            margin-left: auto;
            margin-right: auto; /* Centering the form */
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
<div class="container">
    <div class="form-container">
        <h2 class="text-center">Edit Profile</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="txt_name">Name</label>
                <input required type="text" class="form-control" name="txt_name" 
                       title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" 
                       pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" value="<?php echo htmlspecialchars($row['teacher_name']); ?>"/>
            </div>
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input required type="email" class="form-control" name="txt_email" 
                       id="txt_email" value="<?php echo htmlspecialchars($row['teacher_email']); ?>" />
            </div>
            <div class="form-group">
                <label for="txt_contact">Contact</label>
                <input required type="text" class="form-control" name="txt_contact" 
                       pattern="[7-9]{1}[0-9]{9}" 
                       title="Phone number with 7-9 and remaining 9 digits with 0-9" 
                       id="txt_contact" value="<?php echo htmlspecialchars($row['teacher_contact']); ?>" />
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" class="btn btn-primary">Edit</button>
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
