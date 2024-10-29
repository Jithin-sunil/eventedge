<?php
include('../Assets/Connection/Connection.php');
$departmentid = $departmentname = "";
include('Head.php');

if (isset($_POST['btn_submit'])) {
    $name = $_POST["txt_name"];
    $dept_id = $_POST["dept_id"];

    if ($dept_id == "") {
        $insqry = "INSERT INTO tbl_department(department_name) VALUES ('$name')";
        if ($con->query($insqry)) {
            echo "<script>alert('Inserted');</script>";
        } else {
            echo "Failed";
        }
    } else {
        $update = "UPDATE tbl_department SET department_name='$name' WHERE department_id=$dept_id";
        if ($con->query($update)) {
            echo "<script>
                    alert('Data updated');
                    window.location='Department.php';
                  </script>";
        }
    }
}

if (isset($_GET["did"])) {
    $delqry = "DELETE FROM tbl_department WHERE department_id=" . $_GET["did"];
    if ($con->query($delqry)) {
        echo "<script>
                alert('Data deleted');
                window.location='Department.php';
              </script>";
    }
}

if (isset($_GET["eid"])) {
    $selqry = "SELECT * FROM tbl_department WHERE department_id=" . $_GET["eid"];
    $result = $con->query($selqry);
    $data = $result->fetch_assoc();
    $departmentname = $data["department_name"];
    $departmentid = $data["department_id"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container, .table-container {
            margin: 30px auto;
            max-width: 600px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2, .table-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-action {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2>Department</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="txt_name" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="txt_name" name="txt_name" 
                       pattern="^[A-Z]+[a-zA-Z ]*$" 
                       title="Only alphabets and spaces, starting with a capital letter" 
                       value="<?php echo $departmentname; ?>" required>
                <input type="hidden" name="dept_id" value="<?php echo $departmentid; ?>">
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="container table-container">
        <h2>Department List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selqry = "SELECT * FROM tbl_department";
                $result = $con->query($selqry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    echo "<tr>
                            <td>$i</td>
                            <td>{$row['department_name']}</td>
                            <td>
                                <a href='Department.php?eid={$row['department_id']}' 
                                   class='btn btn-warning btn-sm btn-action'>Edit</a>
                                <a href='Department.php?did={$row['department_id']}' 
                                   class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>

<?php include('Foot.php'); ?>
