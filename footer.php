<!-- Main Footer-->
<footer class="main-footer">
    <div class="container">
        <div class="footer-area text-center">
            <div class="row">
                <div class="col-md-4">
                    <h2 style="color: white; margin-bottom: 20px; color: #1B676B;">Quick Links</h2>
                    <ul class="categories-menu" style="text-align: left; background: transparent;">
                        <li><a href="download.php" style="color: black;">Downloads</a></li>
                        <li><a href="#" style="color: black;">News and Events</a></li>
                        <li><a href="#" style="color: black;">Help Tutorial</a></li>
                        <li><a href="policy.php" style="color: black;">Privacy Disclaimer</a></li>
                        <li><a href="#" style="color: black;">Terms and Conditions</a></li>
                    </ul>
                    <ul class="social-links">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-vine"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-7">
                    <div class="contact-form">
                    <h2 style="color: white; margin-bottom: 20px; color: #1B676B;">Have a Doubt, Send us a Message</h2>
                        <form class="form-group" style="background-color: transparent; border: 1px solid black; padding: 20px;">
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile">
                            </div>
                            <div class="form-group">
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" placeholder="Message" class="form-control"></textarea>
                            </div>
                            <p id="error_message" style="color: red;"></p>
                            <div class="form-group">
                                <button type="button" id="button" class="theme-btn btn-style-two">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>            
    </div>
</footer>
<!--End Main Footer-->

<!--Footer Bottom Section-->
<section class="footer-bottom">
    <div class="container">
        <div class="copyright-text text-center">
            Copyright &copy; <a href="#">Government of Assam</a> 2020. All Rights Reserved
        </div>
    </div>
</section>
<!--End Footer Bottom Section-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>


<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/jquery.countTo.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/appear.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/isotope.js"></script>
<script src="js/bxslider.js"></script>
<script src="js/validate.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<!-- Custom script -->
<script src="js/custom.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBevTAR-V2fDy9gQsQn1xNHBPH2D36kck0"></script>
<script src="js/map-script.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#table1').DataTable();
    });
</script>
<script>
        $(document).ready(function(){
            $("#button").click(function(){
                var name=$("#name").val();
                var email=$("#email").val();
                var mobile=$("#mobile").val();
                var subject=$("#subject").val();
                var message=$("#message").val();
                if(name == '' || email == '' || mobile == '' || subject == '' || message == '')  
                {  
                    $('#error_message').html("All Fields are required");
                }
                else{
                    $.ajax({
                        url:'webservice/ajax_message.php',
                        method:'POST',
                        data:{
                            name:name,
                            email:email,
                            mobile:mobile,
                            subject:subject,
                            message:message
                        },
                       success:function(data){
                            $("form").trigger("reset");
                            swal("Success!","Your message sent successfully. We are get back to you soon! Thank You","success");
                       }
                    });
                }
            });
        });
</script>
</div>
</body>
</html>