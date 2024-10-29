<?php
include('../Assets/Connection/Connection.php');

include('Head.php');

if (isset($_GET['did'])) {
    $insqry = "INSERT INTO tbl_request(request_date, student_id, event_id) VALUES (CURDATE(), '" . $_SESSION['sid'] . "', '" . $_GET['did'] . "')";
    if ($con->query($insqry)) {
        echo '<script>
                alert("Request to Event sent.");
                window.location = "ViewEvents.php";
              </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .event-table {
            margin-top: 20px;
        }
        .event-table th, .event-table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center my-4">View Events</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered table-hover event-table">
                <thead class="thead-light">
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
                    $selqry = "SELECT * FROM tbl_event e INNER JOIN tbl_event_type t ON t.event_type_id = e.event_type_id";
                    $result = $con->query($selqry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['event_details']; ?></td>
                            <td><?php echo $row['event_date']; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td>
                                <a href="ViewEvents.php?did=<?php echo $row['event_id']; ?>" class="btn btn-primary btn-sm">Request Event</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
include('Foot.php');
?>
