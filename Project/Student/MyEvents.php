<?php
include('../Assets/Connection/Connection.php');
include('Head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .events-container {
            margin-top: 50px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .table-card {
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }
        .status-accepted {
            color: #28a745;
            font-weight: bold;
        }
        .status-rejected {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container events-container">
        <div class="card table-card">
            <div class="card-body">
                <h3 class="text-center mb-4">My Events</h3>
                <table class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Event</th>
                            <th>Details</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selqry = "SELECT * FROM tbl_request r 
                                   INNER JOIN tbl_event e ON e.event_id = r.event_id";
                        $result = $con->query($selqry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><?php echo $row['event_date']; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['event_details']; ?></td>
                            <td class="text-center">
                                <?php
                                if ($row['request_status'] == 0) {
                                    echo '<span class="status-pending">Pending</span>';
                                } elseif ($row['request_status'] == 1) {
                                    echo '<span class="status-accepted">Accepted</span>';
                                    ?>
                                    <a href="GroupChat.php?id=<?php echo $row['event_id']?>">Chat</a>
                                    <?php
                                } else {
                                    echo '<span class="status-rejected">Rejected</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
include('Foot.php');
?>
