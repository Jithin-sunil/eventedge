<?php
include("../Assets/Connection/Connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Group Chat</title>
    <link rel="icon" type="image/png" href="../Assets/Templates/Chat/friendskit/assets/img/favicon.png" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- Core CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Chat/friendskit/assets/css/app.css">
    <link rel="stylesheet" href="../Assets/Templates/Chat/friendskit/assets/css/core.css">
</head>

<body >

    <!-- Pageloader -->
    <div class="pageloader"></div>
    <!-- <div class="infraloader is-active"></div> -->

    <div class="chat-wrapper is-standalone">
        <div class="chat-inner">

            <!-- Chat top navigation -->
            <?php
            // Fetch group details
            $groupId = $_GET["id"];
            $selQry =  "SELECT * FROM tbl_event WHERE event_id='$groupId'";
            $result = $con->query($selQry);
            if ($row = $result->fetch_assoc()) {
            ?>
            <div class="chat-nav">
                <div class="nav-start">
                    <div class="recipient-block">
                        <!-- <div class="avatar-container">
                            <img class="user-avatar" src="../Assets/File/Group/<?php 
                            // echo $row["group_photo"]; 
                            ?>" alt="">
                        </div> -->
                        <div class="username">
                            <span><?php echo $row["event_name"]; ?></span>
                        </div>
                    </div>
                </div>
                <div class="nav-end">
                    <a href="hompage.php" class="chat-nav-item is-icon is-hidden-mobile">
                        <i data-feather="home"></i>
                    </a>
                </div>
            </div>
            <?php }
            ?>

            

            <!-- Chat body -->
            <div id="chat-body" class="chat-body">
                <!-- Conversation -->
                <div id="conversation" class="chat-body-inner has-slimscroll"></div>
                <!-- Compose message area -->
                <div class="chat-action">
                    <div class="chat-action-inner">
                        <div class="control" style="text-align: center">
                            <textarea class="textarea comment-textarea" id="msg" rows="2"></textarea>
                            <input type="hidden" value="<?php echo $_GET["id"]; ?>" name="txt_hid" id="txt_id" onclick="sendChat()">
                            <input type="button" value="Send" name="btn_send" id="btn_send" onclick="sendChat()" style="border: none; background-color: #5082c3; border-radius: 15px 10px; color: white; margin: 10px; margin-bottom: 30px; width: 30%; height: 25px">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function sendChat() {
            var chat = document.getElementById("msg").value;
            var id = document.getElementById("txt_id").value;
            if (chat.length <= 35) {
                $.ajax({
                    url: "../Assets/AjaxPages/AjaxGroupChatS.php?chat=" + chat + "&id=" + id,
                    success: function(result) {
                        document.getElementById("msg").value = "";
                        $('#conversation').animate({
                            scrollTop: $('#conversation')[0].scrollHeight
                        });
                    }
                });
            } else {
                alert("Character Length less Than 35 Allowed");
                document.getElementById("msg").value = "";
                $('#conversation').animate({
                    scrollTop: $('#conversation')[0].scrollHeight
                });
            }
        }

        $(document).ready(function() {
            setInterval(function() {
                var cid = document.getElementById("txt_id").value;
                $("#conversation").load('../Assets/AjaxPages/AjaxChatLoadS.php?cid=' + cid)
            }, 50);
        });
    </script>
    <!-- Core js -->
    <script src="../Assets/Templates/Chat/friendskit/assets/js/app.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="../Assets/Templates/Chat/friendskit/assets/data/tipuedrop_content.js"></script>
    <script src="../Assets/Templates/Chat/friendskit/assets/js/global.js"></script>
    <script src="../Assets/Templates/Chat/friendskit/assets/js/navbar-v1.js"></script>
    <script src="../Assets/Templates/Chat/friendskit/assets/js/sidebar-v1.js"></script>
</body>

</html>
