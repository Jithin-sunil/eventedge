<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if (isset($_GET['tid'])) {
    $up=" insert into tbl_coordinator (teacher_id,event_id) values('".$_GET['tid']."','".$_GET['eid']."')";
    if($con->query($up))
    {
        ?>
        <script>
            alert('Added to Coordinator');
            window.location='Event.php';
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                               INNER JOIN tbl_department d ON d.department_id = t.department_id where teacher_status='1'";
                        $result = $con->query($selqry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['teacher_name']; ?></td>
                                <td><?php echo $row['teacher_contact']; ?></td>
                                <td><?php echo $row['teacher_email']; ?></td>
                                <td><img src="../Assets/TeacherPhotos/<?php echo $row['teacher_photo']; ?>" width="50"
                                        height="50" class="img-thumbnail" /></td>
                                <td><a href="../Assets/Proofs/<?php echo $row['teacher_proof']; ?>" target="_blank">View
                                        Proof</a></td>
                                <td><?php echo $row['department_name']; ?></td>
                                <td>
                                   
                                    <a href="Teachers.php?tid=<?php echo $row['teacher_id']; ?>&eid=<?php echo $_GET['eid'] ?>"
                                        class="btn btn-danger btn-sm btn-action">Assign Events</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
</body>
</html>

<?php
include('Foot.php');
?>
