<?php
include('../Assets/Connection/Connection.php');
$courseid = $coursename = $departmentid = "";
include('Head.php');

if (isset($_POST['btn_submit'])) {
    $course = $_POST['txt_course'];
    $course_id = $_POST['course_id'];
    $coursedept = $_POST['sel_dept'];
    if ($course_id == "") {
        $insqry = "INSERT INTO tbl_course(course_name, department_id) VALUES ('$course', '$coursedept')";
        if ($con->query($insqry)) {
            echo "<script>alert('Data inserted'); window.location='Course.php';</script>";
        } else {
            echo "Insertion failed";
        }
    } else {
        $update = "UPDATE tbl_course SET course_name='$course' WHERE course_id=$course_id";
        if ($con->query($update)) {
            echo "<script>alert('Data Updated'); window.location='Course.php';</script>";
        }
    }
}

if (isset($_GET["did"])) {
    $delqry = "DELETE FROM tbl_course WHERE course_id=" . $_GET["did"];
    if ($con->query($delqry)) {
        echo "<script>alert('Data Deleted'); window.location='Course.php';</script>";
    }
}

if (isset($_GET["eid"])) {
    $selqry = "SELECT * FROM tbl_course WHERE course_id=" . $_GET["eid"];
    $result = $con->query($selqry);
    $data = $result->fetch_assoc();
    $coursename = $data['course_name'];
    $courseid = $data['course_id'];
    $departmentid = $data['department_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container, .table-container {
            margin: 30px auto;
            max-width: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .table-container {
            max-width: 800px;
        }

        .table-container h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .btn-action {
            margin-right: 10px;
        }
    </style>
</head>

<body>

<div class="container form-container">
    <h2>Add Course</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="txt_course" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="txt_course" name="txt_course" 
                   pattern="^[A-Z]+[a-zA-Z ]*$" 
                   title="Only alphabets and spaces, starting with a capital letter" 
                   value="<?php echo $coursename; ?>" required>
            <input type="hidden" name="course_id" value="<?php echo $courseid; ?>">
        </div>

        <div class="mb-3">
            <label for="sel_dept" class="form-label">Department</label>
            <select name="sel_dept" id="sel_dept" class="form-select" required>
                <option value="">-- Select Department --</option>
                <?php
                $selq = "SELECT * FROM tbl_department";
                $res = $con->query($selq);
                while ($rows = $res->fetch_assoc()) {
                    echo "<option value='{$rows["department_id"]}'" . 
                         ($departmentid == $rows["department_id"] ? " selected" : "") . 
                         ">{$rows["department_name"]}</option>";
                }
                ?>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<div class="container table-container">
    <h2>Course List</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Course</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selqry = "SELECT * FROM tbl_course c INNER JOIN tbl_department d ON d.department_id = c.department_id";
            $result = $con->query($selqry);
            while ($row = $result->fetch_assoc()) {
                $i++;
                echo "<tr>
                        <td>$i</td>
                        <td>{$row['course_name']}</td>
                        <td>{$row['department_name']}</td>
                        <td>
                            <a href='Course.php?eid={$row["course_id"]}' class='btn btn-warning btn-sm btn-action'>Edit</a>
                            <a href='Course.php?did={$row["course_id"]}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>

<?php include('Foot.php'); ?>
