<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if (isset($_GET['aid'])) {
    $update = "UPDATE tbl_request SET request_status='1' WHERE request_id='" . $_GET["aid"] . "'";
    if ($con->query($update)) {
        echo "
        <script>
            alert('Accepted');
            window.location='ViewRequest.php';
        </script>";
    }
}

if (isset($_GET['rid'])) {
    $updat = "UPDATE tbl_request SET request_status='2' WHERE request_id='" . $_GET["rid"] . "'";
    if ($con->query($updat)) {
        echo "
        <script>
            alert('Rejected');
            window.location='ViewRequest.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Request</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .btn-accept {
            background-color: #28a745;
            color: white;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .btn-accept:hover {
            background-color: #218838;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="table-container">
                <h3 class="text-center mb-4">View Requests</h3>

                <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Contact</th>
                            <th>Course</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Event</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selqry = "SELECT * FROM tbl_request r
                                    INNER JOIN tbl_event e ON e.event_id = r.event_id
                                    INNER JOIN tbl_student s ON s.student_id = r.student_id
                                    INNER JOIN tbl_course c ON c.course_id = s.course_id
                                    INNER JOIN tbl_department d ON d.department_id = c.department_id";
                        $result = $con->query($selqry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            $status = ($row['request_status'] == '1') ? 'Accepted' : 
                                      (($row['request_status'] == '2') ? 'Rejected' : 'Pending');
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['student_contact']; ?></td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['department_name']; ?></td>
                            <td><?php echo $row['request_date']; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td>
                                <a href="ViewRequest.php?aid=<?php echo $row['request_id']; ?>" 
                                   class="btn btn-accept btn-sm">Accept</a>
                                <a href="ViewRequest.php?rid=<?php echo $row['request_id']; ?>" 
                                   class="btn btn-reject btn-sm">Reject</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('Foot.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
