<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if (isset($_POST['bt_assign'])) {
    $eventid = $_POST['sel_event'];
    $insqry = "INSERT INTO tbl_assign_teachers(teacher_id, event_id) VALUES ('" . $_GET["aid"] . "', '" . $eventid . "')";
    if ($con->query($insqry)) {
        echo "<script>alert('Assigned')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Teacher</title>

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="form-container col-md-4">
        <h2>Assign Teacher</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="mb-3">
                <label for="sel_event" class="form-label">Event</label>
                <select name="sel_event" id="sel_event" class="form-select" required>
                    <option value="">--Select--</option>
                    <?php
                    $selqry = "SELECT * FROM tbl_event";
                    $result = $con->query($selqry);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row["event_id"] ?>"><?php echo $row["event_name"]; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="bt_assign" id="bt_assign" class="btn btn-primary">Assign</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>

<?php
include('Foot.php');
?>
