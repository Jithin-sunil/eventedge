<?php
include("../Connection/Connection.php");
session_start();

$group_id = $_GET["cid"];
$selQry = "
    SELECT *
    FROM tbl_chat gc
    LEFT JOIN tbl_coordinator t ON gc.coordinator_id = t.coordinator_id
    LEFT JOIN tbl_student s ON gc.student_id = s.student_id
    WHERE gc.event_id = '$group_id'
    ORDER BY gc.chat_id";

$result = $con->query($selQry);

while ($row = $result->fetch_assoc()) {
    $isSentByUser = false;

    // Determine if the logged-in user is the sender
    if (isset($_SESSION["cid"]) && $row["coordinator_id"] == $_SESSION["cid"]) {
        // Logged-in user is the coordinator
        $isSentByUser = true;
        $name = $row["student_name"] . " (Coordinator)";
        $photo = $row["student_photo"];
    } else if (isset($_SESSION["sid"]) && $row["student_id"] == $_SESSION["sid"]) {
        // Logged-in user is a student
        $isSentByUser = true;
        $name = $row["student_name"];
        $photo = $row["student_photo"];
    } else {
        // Display other users' messages
        $name = $row["coordinator_id"] ? $row["student_name"] . " (Coordinator)" : $row["student_name"];
        $photo = $row["student_photo"];
    }

    // Determine message layout based on whether it was sent by the logged-in user
    if ($isSentByUser) {
?>
        <div class="chat-message is-sent">
            <img src="../Assets/Files/Student/<?php echo $photo; ?>" alt="">
            <div class="message-block">
                <span><?php echo $name; ?></span>
                <div class="message-text"><?php echo $row["chat_content"]; ?></div>
                <span style="font-size:10px;"><?php echo date("h:i A", strtotime($row["chat_datetime"])); ?></span>
            </div>
        </div>
<?php
    } else {
?>
        <div class="chat-message is-received">
            <img src="../Assets/Files/Student/<?php echo $photo; ?>" alt="">
            <div class="message-block">
                <span><?php echo $name; ?></span>
                <div class="message-text"><?php echo $row["chat_content"]; ?></div>
                <span style="font-size:10px;"><?php echo date("h:i A", strtotime($row["chat_datetime"])); ?></span>
            </div>
        </div>
<?php
    }
}
?>
