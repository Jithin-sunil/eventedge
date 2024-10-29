<?php

include('../Assets/Connection/Connection.php');
include('Head.php');

// Handle request acceptance
if (isset($_GET['aid'])) {
    $update = "UPDATE tbl_request SET request_status='1', coordinator_id='".$_SESSION['cid']."' WHERE request_id='" . $_GET["aid"] . "'";
    if ($con->query($update)) {
        echo "
        <script>
        alert('Accepted');
        window.location='ViewRequest.php?eid=<?php echo $_GET[eid] ?>';
        </script>";
    }
}

// Handle request rejection
if (isset($_GET['rid'])) {
    $updat = "UPDATE tbl_request SET request_status='2' ,  coordinator_id='".$_SESSION['cid']."'  WHERE request_id='" . $_GET["rid"] . "'";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Request</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .request-table {
            margin-top: 20px;
        }

        .table {
            border-radius: 0.5rem;
            overflow: hidden;
            /* Ensures the corners are rounded */
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">View Requests</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered table-striped request-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student Contact</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Event</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selqry = "SELECT * FROM tbl_request r INNER JOIN tbl_event e ON e.event_id = r.event_id
                     inner join tbl_student s on s.student_id=r.student_id where r.event_id=" . $_GET['eid'];
                    $result = $con->query($selqry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['student_name'] ?></td>
                            <td><?php echo $row['student_contact'] ?></td>
                            <td><?php echo htmlspecialchars($row['request_date']); ?></td>
                            <td>
                                <?php
                                // Display status as human-readable text using if-else
                                if ($row['request_status'] == 0) {
                                    echo "Pending";
                                } else if ($row['request_status'] == 1) {
                                    echo "Approved";
                                } else if ($row['request_status'] == 2) {
                                    echo "Rejected";
                                }
                                else if ($row['request_status'] == 3) {
                                    echo "Added to Group";
                                }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                            <td>
                                <?php if ($row['request_status'] == 0) { ?>
                                    <a href="ViewRequest.php?aid=<?php echo $row["request_id"]; ?>"
                                        class="btn btn-success btn-sm">Accept</a>
                                    <a href="ViewRequest.php?rid=<?php echo $row["request_id"]; ?>"
                                        class="btn btn-danger btn-sm">Reject</a>
                                <?php } else if ($row['request_status'] == 1) { ?>
                                        

                                            <a href="GroupChat.php?id=<?php echo $row['event_id'] ?>">Chat</a>

                                <?php } else { ?>
                                            <span class="text-danger">Rejected</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
include('Foot.php');
?>