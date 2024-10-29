<?php
include('../Assets/Connection/Connection.php');
if (isset($_POST['btn_register'])) {
    $student = $_POST['txt_name'];
    $studentcontact = $_POST['txt_contact'];
    $studentemail = $_POST['txt_email'];
    $studentcourse = $_POST['sel_course'];
    $studentsem = $_POST['sel_semester'];
    $studentpass = $_POST['txt_password'];
    $photo = $_FILES['file_photo']['name'];
    $tempphoto = $_FILES['file_photo']['tmp_name'];
    move_uploaded_file($tempphoto, "../Assets/Files/Student/" . $photo);
    
    $insqry = "INSERT INTO tbl_student(student_name, student_contact, student_email, course_id, student_photo, student_password) VALUES ('$student', '$studentcontact', '$studentemail', '$studentcourse', '$photo', '$studentpass')";
    
    if ($con->query($insqry)) {
        echo "<script>
                alert('Data Inserted');
                window.location='Student.php';
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
    <title>Student Registration</title>
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
        <h2 class="text-center my-4">Student Registration</h2>
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
                <label for="sel_semester">Semester</label>
                <select name="sel_semester" id="sel_semester" class="form-control">
                    <option>--select--</option>
                    <?php
                    $selqry = "SELECT * FROM tbl_semester";
                    $res = $con->query($selqry);
                    while ($row = $res->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row["semester_id"] ?>"><?php echo $row["semester_name"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sel_dept">Department</label>
                <select name="sel_dept" id="sel_dept" class="form-control" onchange="getPlace(this.value)">
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
                <label for="sel_course">Course</label>
                <select name="sel_course" id="sel_course" class="form-control">
                    <option>--select--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="txt_password">Password</label>
                <input required type="password" name="txt_password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters" id="txt_password" />
            </div>
            <div class="form-group">
                <label for="file_photo">Photo</label>
                <input required type="file" name="file_photo" class="form-control-file" id="file_photo" />
            </div>
            <div class="form-group text-center">
                <input type="submit" name="btn_register" id="btn_register" class="btn btn-primary" value="Register" />
            </div>
        </form>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getPlace(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxCourse.php?did=" + did,
                success: function (result) {
                    $("#sel_course").html(result);
                }
            });
        }
    </script>
</body>
</html>
