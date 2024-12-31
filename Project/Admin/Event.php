<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if (isset($_POST['btn_submit'])) {
    $event = $_POST['txt_name'];
    $eventdate = $_POST['txt_date'];
    $eventdetails = $_POST['txt_details'];
    $eventtype = $_POST['sel_type'];

    $insqry = "INSERT INTO tbl_event(event_name, event_date, event_details, event_type_id) 
               VALUES ('$event', '$eventdate', '$eventdetails', '$eventtype')";
    if ($con->query($insqry)) {
        echo "<script>
                alert('Data inserted');
                window.location='Event.php';
              </script>";
    } else {
        echo "Failed";
    }
}

if (isset($_GET['did'])) {
    $delqry = "DELETE FROM tbl_event WHERE event_id=" . $_GET['did'];
    if ($con->query($delqry)) {
        echo "<script>
                alert('Data Deleted');
                window.location='Event.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            margin: 30px auto;
            max-width: 500px;
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
            margin: 30px auto;
            max-width: 800px;
        }

        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2>Add New Event</h2>
        <form method="post" action="">
            <div class="row mb-3">
                <div class="col-12">
                    <label for="txt_name" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="txt_name" name="txt_name" 
                           pattern="^[A-Z]+[a-zA-Z ]*$" 
                           title="Name allows only alphabets, spaces, and must start with a capital letter" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label for="txt_date" class="form-label">Event Date</label>
                    <input type="date" class="form-control" id="txt_date" name="txt_date" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label for="txt_details" class="form-label">Event Details</label>
                    <textarea class="form-control" id="txt_details" name="txt_details" rows="3" required></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label for="sel_type" class="form-label">Event Type</label>
                    <select class="form-select" id="sel_type" name="sel_type" required>
                        <option value="" disabled selected>-- Select --</option>
                        <?php
                        $selqry = "SELECT * FROM tbl_event_type";
                        $result = $con->query($selqry);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['event_type_id']}'>{$row['event_type_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="container table-container">
        <h2 class="text-center">Event List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Details</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sel = "SELECT * FROM tbl_event e 
                        INNER JOIN tbl_event_type t ON t.event_type_id = e.event_type_id";
                $res = $con->query($sel);
                while ($rows = $res->fetch_assoc()) {
                    $i++;
                    echo "<tr>
                            <td>{$i}</td>
                            <td>{$rows['event_name']}</td>
                            <td>{$rows['event_date']}</td>
                            <td>{$rows['event_details']}</td>
                            <td>{$rows['event_type_name']}</td>
                            <td>
                                <a href='Event.php?did={$rows['event_id']}' class='btn btn-danger btn-sm btn-action'>Delete</a>
                                <a href='Teachers.php?eid={$rows['event_id']}' class='btn btn-danger btn-sm btn-action'>Assign Teacher</a>
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

<?php
include('Foot.php');
?>
