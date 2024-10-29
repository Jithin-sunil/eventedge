<?php
include('../Assets/Connection/Connection.php');
$eventtypename = $eventtypeid = "";
include('Head.php');

if (isset($_POST['btn_submit'])) {
    $eventtype = $_POST['txt_type'];
    $typeid = $_POST['type_id'];
    if ($typeid == "") {
        $insqry = "INSERT INTO tbl_event_type(event_type_name) VALUES('$eventtype')";
        if ($con->query($insqry)) {
            echo "<script>
                    alert('Data Inserted');
                    window.location='EventType.php';
                  </script>";
        } else {
            echo "Failed";
        }
    } else {
        $update = "UPDATE tbl_event_type SET event_type_name='$eventtype' WHERE event_type_id=$typeid";
        if ($con->query($update)) {
            echo "<script>
                    alert('Data Updated');
                    window.location='EventType.php';
                  </script>";
        }
    }
}

if (isset($_GET['did'])) {
    $delqry = "DELETE FROM tbl_event_type WHERE event_type_id=" . $_GET['did'];
    if ($con->query($delqry)) {
        echo "<script>
                alert('Data Deleted');
                window.location='EventType.php';
              </script>";
    }
}

if (isset($_GET['eid'])) {
    $selqry = "SELECT * FROM tbl_event_type WHERE event_type_id=" . $_GET['eid'];
    $result = $con->query($selqry);
    $data = $result->fetch_assoc();
    $eventtypename = $data['event_type_name'];
    $eventtypeid = $data['event_type_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Type Management</title>

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
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2>Event Type Form</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="txt_type" class="form-label">Event Type</label>
                <input type="text" class="form-control" id="txt_type" name="txt_type" 
                       pattern="^[A-Z]+[a-zA-Z ]*$" 
                       title="Name allows only alphabets, spaces, and must start with a capital letter" 
                       value="<?php echo $eventtypename; ?>" required>
                <input type="hidden" name="type_id" value="<?php echo $eventtypeid; ?>">
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="container table-container">
        <h2>Event Types List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Event Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selqry = "SELECT * FROM tbl_event_type";
                $result = $con->query($selqry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['event_type_name']; ?></td>
                        <td>
                            <a href="EventType.php?eid=<?php echo $row['event_type_id']; ?>" class="btn btn-warning btn-sm btn-action">Edit</a>
                            <a href="EventType.php?did=<?php echo $row['event_type_id']; ?>" class="btn btn-danger btn-sm btn-action">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include('Foot.php');
?>
