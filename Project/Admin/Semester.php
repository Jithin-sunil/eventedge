<?php
include('../Assets/Connection/Connection.php');
$semesterid = $semestername = "";
include('Head.php');

if (isset($_POST['btn_submit'])) {
    $semester = $_POST["sem_name"];
    $semesterid = $_POST["sem_id"];

    if ($semesterid == "") {
        $insqry = "INSERT INTO tbl_semester(semester_name) VALUES ('$semester')";
        if ($con->query($insqry)) {
            echo "<script>alert('Data inserted'); window.location='Semester.php';</script>";
        } else {
            echo "Insertion failed";
        }
    } else {
        $update = "UPDATE tbl_semester SET semester_name='$semester' WHERE semester_id=$semesterid";
        if ($con->query($update)) {
            echo "<script>alert('Data Updated'); window.location='Semester.php';</script>";
        }
    }
}

if (isset($_GET["did"])) {
    $delqry = "DELETE FROM tbl_semester WHERE semester_id=" . $_GET["did"];
    if ($con->query($delqry)) {
        echo "<script>alert('Data Deleted'); window.location='Semester.php';</script>";
    }
}

if (isset($_GET["eid"])) {
    $selqry = "SELECT * FROM tbl_semester WHERE semester_id=" . $_GET["eid"];
    $result = $con->query($selqry);
    $data = $result->fetch_assoc();
    $semestername = $data["semester_name"];
    $semesterid = $data["semester_id"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semester Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container, .table-container {
            margin: 30px auto;
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .table-container {
            max-width: 600px;
        }

        .table-container h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>

<body>

<div class="container form-container">
    <h2>Add Semester</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="sem_name" class="form-label">Semester Name</label>
            <input type="text" class="form-control" id="sem_name" name="sem_name" 
                    
                   value="<?php echo $semestername; ?>" required>
            <input type="hidden" name="sem_id" value="<?php echo $semesterid; ?>">
        </div>

        <div class="text-center">
            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<div class="container table-container">
    <h2>Semester List</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Semester</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selqry = "SELECT * FROM tbl_semester";
            $result = $con->query($selqry);
            while ($row = $result->fetch_assoc()) {
                $i++;
                echo "<tr>
                        <td>$i</td>
                        <td>{$row['semester_name']}</td>
                        <td>
                            <a href='Semester.php?eid={$row['semester_id']}' class='btn btn-warning btn-sm btn-action'>Edit</a>
                            <a href='Semester.php?did={$row['semester_id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include('Foot.php'); ?>
