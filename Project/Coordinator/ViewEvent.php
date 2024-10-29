<?php
include('../Assets/Connection/Connection.php');

include('Head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Event</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .event-table {
            margin-top: 20px;
        }
        .table {
            border-radius: 0.5rem;
            overflow: hidden; /* Ensures the corners are rounded */
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4">View Events</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered table-striped event-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selqry = "SELECT * FROM tbl_coordinator t INNER JOIN tbl_event c ON c.event_id = t.event_id inner join tbl_event_type e on e.event_type_id=c.event_type_id WHERE coordinator_id='" . $_SESSION['cid'] . "'";
                    $result = $con->query($selqry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_details']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_type_name']); ?></td>
                        <td>
                            <a href="ViewRequest.php?eid=<?php echo $row['event_id'] ?>">View Event Request</a>
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
