<?php
include("../Connection/Connection.php");
session_start();

    echo $insQry="insert into tbl_chat (event_id,coordinator_id,chat_datetime,chat_content) 
    values('".$_GET["id"]."','".$_SESSION["cid"]."',NOW(),'".$_GET["chat"]."')";
    if($con->query($insQry))
    {
        echo "sended";
    }
    else
    {
        echo "failed";
        // echo $insQry;
    }
    
?>