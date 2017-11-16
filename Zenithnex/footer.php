</main>

       


    </div>

    <footer class="app-footer">
        <a href="#">ZenithNEX</a> &copy; 2017
        <span class="float-right"> <a href="contactus.php">Contact-US</a>
        </span>
    </footer>
   
    <!-- Bootstrap and necessary plugins -->
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    
    <script src="js/popper.min.js"></script>
    <script src="js/pace.min.js"></script>
    <script type="text/javascript">

        $('.navbar-toggler').click(function(){

            if ($(this).hasClass('sidebar-toggler')) {
              $('body').toggleClass('sidebar-hidden');
            }

            if ($(this).hasClass('sidebar-minimizer')) {
              $('body').toggleClass('sidebar-minimized');
            }

            if ($(this).hasClass('aside-menu-toggler')) {
              $('body').toggleClass('aside-menu-hidden');
            }

            if ($(this).hasClass('mobile-sidebar-toggler')) {
              $('body').toggleClass('sidebar-mobile-show');
            }

          });
         $('.sidebar-close').click(function(){
            $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
          });                    
         $('#sendBTC').on('modal', function () {
              $('#sendBTC').modal('show');
              $('.modal fade').toggleClass(".fade.show");

            });
         // $("#submit_otp").click(function(){
         //      var post_Text = $("#otp_value_text").val();
         //      $.post("/BCHwallet/verifyemail.php", {post_Text:post_Text} ,function(resp){
         //          if(resp !== "OK"){
         //              console.log("ERROR OCCURED "+resp);
                      
         //          }
         //      });
         //  });
         function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57))
                return false;

            return true;
          }
    </script>


    <!-- Plugins and scripts required by all views -->
    <script src="js/chart.min.js"></script>

    <!-- GenesisUI main scripts -->

    <script src="js/app.js"></script>

</body>

</html>
