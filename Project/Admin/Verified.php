<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if (isset($_GET['rid'])) {
    $update = "UPDATE tbl_teacher SET teacher_status='2' WHERE teacher_id='" . $_GET["rid"] . "'";
    if ($con->query($update)) {
        echo "<script>
                alert('Rejected');
                window.location='Verified.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verified Teachers</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            margin: 50px auto;
            max-width: 90%;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .img-thumbnail {
            height: 50px;
            width: 50px;
            object-fit: cover;
        }

        .btn-action {
            margin: 5px;
        }
    </style>
</head>

<body>
    <div class="container table-container">
        <h2 class="text-center mb-4">Verified Teachers</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Proof</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selqry = "SELECT * FROM tbl_teacher t 
                               INNER JOIN tbl_department d ON d.department_id = t.department_id 
                               WHERE teacher_status = '1'";
                    $result = $con->query($selqry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['teacher_name']; ?></td>
                            <td><?php echo $row['teacher_contact']; ?></td>
                            <td><?php echo $row['teacher_email']; ?></td>
                            <td><img src="../Assets/TeacherPhotos/<?php echo $row['teacher_photo']; ?>" class="img-thumbnail" /></td>
                            <td><a href="../Assets/Proofs/<?php echo $row['teacher_proof']; ?>" target="_blank">View Proof</a></td>
                            <td><?php echo $row['department_name']; ?></td>
                            <td>
                                <a href="Verified.php?rid=<?php echo $row['teacher_id']; ?>" class="btn btn-danger btn-sm btn-action">Reject</a>
                               
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>

<?php
include('Foot.php');
?>
