
</div>
<br><br><br>
<br><br><br>
<br><br><br>
<div class="footer_section">
         

      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free Html Templates</a> Distribution by <a href="https://themewagon.com">ThemeWagon</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="../Assets/Templates/Main/js/jquery.min.js"></script>
      <script src="../Assets/Templates/Main/js/popper.min.js"></script>
      <script src="../Assets/Templates/Main/js/bootstrap.bundle.min.js"></script>
      <script src="../Assets/Templates/Main/js/jquery-3.0.0.min.js"></script>
      <script src="../Assets/Templates/Main/js/plugin.js"></script>
      <!-- sidebar ../Assets/Templates/Main/-->
      <script src="../Assets/Templates/Main/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="../Assets/Templates/Main/js/custom.js"></script>
      <script>
         $('#myCarousel').carousel({
            interval: false
         });
         
         //scroll slides on swipe for touch enabled devices
         
         $("#myCarousel").on("touchstart", function(event){
         
            var yClick = event.originalEvent.touches[0].pageY;
            $(this).one("touchmove", function(event){
         
                var yMove = event.originalEvent.touches[0].pageY;
                if( Math.floor(yClick - yMove) > 1 ){
                    $(".carousel").carousel('next');
                }
                else if( Math.floor(yClick - yMove) < -1 ){
                    $(".carousel").carousel('prev');
                }
            });
            $(".carousel").on("touchend", function(){
                $(this).off("touchmove");
            });
         });
      </script>
   </body>
</html>