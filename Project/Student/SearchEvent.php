<?php
ob_start();

include("../Assets/Connection/Connection.php");
include('Head.php');
?>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Event</title>
<link rel="stylesheet" href="../Assets/Templates/Search/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style>
            .custom-alert-box{
				z-index:1;
                width: 20%;
                height: 10%;
                position: fixed;
                bottom: 0;
                right: 0;
                left: auto;
            }

            .success {
                color: #3c763d;
                background-color: #dff0d8;
                border-color: #d6e9c6;
                display: none;
            }

            .failure {
                color: #a94442;
                background-color: #f2dede;
                border-color: #ebccd1;
                display: none;
            }

            .warning {
                color: #8a6d3b;
                background-color: #fcf8e3;
                border-color: #faebcc;
                display: none;
            }
        </style>
</head>

<body onload="productCheck()">
        <div class="custom-alert-box">
            <div class="alert-box success">Successful Added to Cart !!!</div>
            <div class="alert-box failure">Failed to Add Cart !!!</div>
            <div class="alert-box warning">Already Added to Cart !!!</div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <h5>Filter Product</h5>
                    <hr>
                    <h6 class="text-info"> Name</h6>
                    <ul class="list-group">
                       
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="text" onkeyup="productCheck()" class="product_check" id="txt_name">
                                </label>
                            </div>
                        </li>
                    </ul>
                    <br />
                    <h6 class="text-info"> Select Category</h6>
                    <ul class="list-group">
                        <?php                           
						 $selCat = "SELECT * from tbl_event_type";
                            $result = $con->query($selCat);
                            while ($row=$result->fetch_assoc()) {
                        ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" onclick="changeSub(),productCheck()" class="form-check-input product_check" value="<?php echo $row["event_type_id"]; ?>" id="type"><?php echo $row["event_type_name"]; ?>
                                </label>
                            </div>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                    <br />
                    
                </div>
                <div class="col-lg-9">
                    <h5 class="text-center" id="textChange">All Products</h5>
                    <hr>
                    <div class="text-center">
                        <img src="../Assets/Templates/Search/loader.gif" id='loder' width="200" style="display: none"/>
                    </div>
                    <div class="row" id="result">
                    </div>

                </div>

            </div>
                        </div>
<script src="../Assets/Templates/Search/jquery.min.js"></script>
        <script src="../Assets/Templates/Search/bootstrap.min.js"></script>
<script src="../Assets/Templates/Search/popper.min.js"></script>
        <script>


function changeSub()
            {
                var cat = get_filter_text('category');
                if (cat.length !== 0)
                {
                    $.ajax({
                        url: "../Assets/AjaxPages/AjaxSearchSubCat.php?data=" + cat,
                        success: function(response) {
                            $("#subcat").html(response);
                        }
                    });

                }
                else
                {
                    $("#subcat").html("");
                }


                function get_filter_text(text_id)
                {
                    var filterData = [];

                    $('#' + text_id + ':checked').each(function() {
                        filterData.push("\'" + $(this).val() + "\'");
                    });
                    return filterData;
                }
            }

            
			function eventrequest(id)
            {
                $.ajax({
                    url: "../Assets/AjaxPages/AjaxEventRequest.php?id=" + id,
                    success: function(response) {
                        
                    }
                });
            }
			
            function productCheck(){
                    $("#loder").show();

                    var action = 'data';
                    var type = get_filter_text('type');
                   
					var name = document.getElementById('txt_name').value;
					


                    $.ajax({
                        url: "../Assets/AjaxPages/AjaxSearchEvent.php?action=" + action +"&type=" + type+"&name=" + name ,
                        success: function(response) {
                            $("#result").html(response);
                            $("#loder").hide();
                            $("#textChange").text("Filtered Products");
                        }
                    });


                }



                function get_filter_text(text_id)
                {
                    var filterData = [];

                    $('#' + text_id + ':checked').each(function() {
                        filterData.push($(this).val());
                    });
                    return filterData;
                }
            
        </script>
    </body>
<?php

ob_flush();
?>
</html>
<?php 
include('Foot.php');
?>