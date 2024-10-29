<?php
include('../Assets/Connection/Connection.php');
if (isset($_POST['btn_submit'])) {
    $teacher = $_POST['txt_name'];
    $teachercontact = $_POST['txt_contact'];
    $teacheremail = $_POST['txt_email'];
    $teacherdep = $_POST['sel_dep'];
    $photo = $_FILES['file_photo']['name'];
    $tempPhoto = $_FILES['file_photo']['tmp_name'];
    move_uploaded_file($tempPhoto, "../Assets/Files/Teacher/" . $photo);
    
    $proof = $_FILES['file_proof']['name'];
    $tempproof = $_FILES['file_proof']['tmp_name'];
    move_uploaded_file($tempproof, "../Assets/Files/Teacher/" . $proof);
    
    $teacherpass = $_POST['txt_password'];

    $insqry = "INSERT INTO tbl_teacher(teacher_name, teacher_contact, teacher_email, department_id, teacher_photo, teacher_proof, teacher_password) VALUES ('$teacher', '$teachercontact', '$teacheremail', '$teacherdep', '$photo', '$proof', '$teacherpass')";
    
    if ($con->query($insqry)) {
        echo "<script>
                alert('Data Inserted');
                window.location='Teacher.php';
              </script>";
    } else {
        echo "Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .registration-form {
            max-width: 400px; /* Reduced width */
            margin: 50px auto; /* Center the form */
            padding: 20px; /* Adjusted padding */
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center my-4">Teacher Registration</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="registration-form">
            <div class="form-group">
                <label for="txt_name">Name</label>
                <input required type="text" name="txt_name" class="form-control" title="Name allows only alphabets, spaces and first letter must be capital letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" />
            </div>
            <div class="form-group">
                <label for="txt_contact">Contact</label>
                <input required type="text" name="txt_contact" class="form-control" pattern="[7-9]{1}[0-9]{9}" title="Phone number starting with 7-9 followed by 9 digits" id="txt_contact" />
            </div>
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input required type="email" name="txt_email" class="form-control" id="txt_email" />
            </div>
            <div class="form-group">
                <label for="sel_dep">Department</label>
                <select name="sel_dep" id="sel_dep" class="form-control">
                    <option>--select--</option>
                    <?php
                    $selqry = "SELECT * FROM tbl_department";
                    $result = $con->query($selqry);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["department_id"] ?>"><?php echo $row["department_name"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="file_photo">Photo</label>
                <input required type="file" name="file_photo" class="form-control-file" id="file_photo" />
            </div>
            <div class="form-group">
                <label for="file_proof">Proof</label>
                <input required type="file" name="file_proof" class="form-control-file" id="file_proof" />
            </div>
            <div class="form-group">
                <label for="txt_password">Password</label>
                <input required type="password" name="txt_password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and one lowercase letter, and at least 8 characters" id="txt_password" />
            </div>
            <div class="form-group text-center">
                <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
            </div>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
