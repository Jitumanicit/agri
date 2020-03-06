<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AIAHS || 6th Assam International Agri Horticultural Shows in India</title>
	<!-- responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- master stylesheet -->
	<link rel="stylesheet" href="css/style.css?vs=35">
	<link rel="stylesheet" href="css/responsive.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" href="images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
</head>
<body>    
<div class="boxed_wrapper">
<!--Start Preloader -->
<div class="preloader"></div>
<!--End Preloader -->
<div class="sdfasd"></div>
<!-- Main Header-->
<header class="main-header">
    <!--Header Top-->
    <div class="header-top">
        <div class="container">
            <div class="clearfix">
                <!--Top Left-->
                <div class="top-left">
                    <ul class="header-info-list">
                        <li>
                            <span class="day">00</span>
                            <p class="day_ref">Days</p>
                        </li>
                        <li>
                            <span class="day">00</span>
                            <p class="day_ref">Hours</p>
                        </li>
                        <li>
                            <span class="day">00</span>
                            <p class="day_ref">Minutes</p>
                        </li>
                        <li>
                            <span class="day">00</span>
                            <p class="day_ref">Seconds</p>
                        </li>
                    </ul>
                </div>
                <!--Top Right-->
                <div class="top-right">
                    <!--Social Box-->
                    <ul class="social-box">
                        <li><a href="register-for-summit.php">Delegate<br> registration</a></li>
                        <li><a href="register-for-b2b.php">B2B<br> registration</a></li>
                        <li><a href="exhibitor-register.php">Exhibitor<br> registration</a></li>
                        <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                echo "<li><a href='#' data-toggle='modal' data-target='#logoutModal'>Logout<br>now</a></li>";
                            } else {
                                echo "<li><a href='login.php'>B2B<br> Login</a></li>";
                            }
                        ?>
                        <li><a href="contact-us.php">Contact<br> us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!--Header-Upper-->
    <div class="header-upper">
        <div class="container">
            <div class="clearfix">
                
                <div class="float-left logo-box">
                    <div class="logo">
                        <a href="index.php"><img src="images/web logo.jpg" alt="" title="" style="height: 86px;width: 288px;"></a>
                    </div>
                </div>
                
                <div class="nav-outer clearfix">
                
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md">
                        <div class="navbar-header">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="index.php">Home</a></li>
                                <li class="dropdown"><a href="#">Agri horti show</a>
                                    <ul>
                                        <li><a href="about-event.php">About the event</a></li>
                                        <li><a href="venue.php">Venue</a></li>
                                        <li><a href="conference-seminers.php">Conference and seminars</a></li>
                                        <li><a href="how-to-register.php">How to register</a></li>
                                        <li><a href="faq.php">FAQs</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Exhibitors</a>
                                    <ul>
                                        <li><a href="about.php">About</a></li>
                                        <li><a href="exhibitor-register.php">Join as exhibitor</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Agri horti sector</a>
                                    <ul>
                                        <li><a href="why-assam.php">Why Assam</a></li>
                                        <li class="dropdown"><a href="">About the sector</a>
                                            <ul>
                                                <li><a href="overview.php">Overview</a></li>
                                                <li><a href="assam-agriculture.php">Agriculture in Assam</a></li>
                                                <li><a href="horticulture-assam.php">Horticulture in Assam</a></li>
                                                <li><a href="food-processing.php">Food Processing in Assam</a></li>
                                                <li><a href="infrastructures.php">Supporting Infrastructures</a></li>
                                                <li><a href="sectors.php">Packaging</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="policy-section.php">Policy</a></li>
                                        <li><a href="key-contact.php">Key contacts</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Useful links</a>
                                    <ul>
                                        <li><a target="_blank" href="https://advantageassam.com/">Advantage Assam</a></li>
                                        <li><a target="_blank" href="https://assam.gov.in/">Government of Assam</a></li>
                                        <li><a target="_blank" href="https://diragri.assam.gov.in/">Directorate of Agriculture</a></li>
                                        <li><a target="_blank" href="https://dirhorti.assam.gov.in/">Director of Horticulture & Food Processing</a></li>
                                        <li><a target="_blank" href="https://agri-horti.assam.gov.in/">Department of Agriculture & Horticulture</a></li>
                                        <li><a target="_blank" href="https://easeofdoingbusinessinassam.in/">Ease of Doing Business in Assam</a></li>
                                        <li><a target="_blank" href="https://www.mofpi.nic.in/">Ministry of Food Processing</a></li>
                                    </ul>
                                </li>
                                <li><a download="download/Shelf of Projects_Assam_21 02 2020_Final.pdf" href="">Shelf of project</a></li>
                            </ul>
                        </div>  
                    </nav>                    
                </div>               
            </div>
        </div>
    </div>
    <!--End Header Upper-->
    
    <!--Sticky Header-->
    <div class="sticky-header stricky">
        <div class="header-top">
            <div class="container">
                <div class="clearfix">
                    <!--Top Left-->
                    <div class="top-left">
                        <ul class="header-info-list">
                            <li>
                                <span class="day">00</span>
                                <p class="day_ref">Days</p>
                            </li>
                            <li>
                                <span class="day">00</span>
                                <p class="day_ref">Hours</p>
                            </li>
                            <li>
                                <span class="day">00</span>
                                <p class="day_ref">Minutes</p>
                            </li>
                            <li>
                                <span class="day">00</span>
                                <p class="day_ref">Seconds</p>
                            </li>
                        </ul>
                    </div>
                    <!--Top Right-->
                    <div class="top-right">
                        <!--Social Box-->
                        <ul class="social-box">
                            <li><a href="register-for-summit.php">Delegate<br> registration</a></li>
                            <li><a href="register-for-b2b.php">B2B<br> registration</a></li>
                            <li><a href="exhibitor-register.php">Exhibitor<br> registration</a></li>
                            <?php
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                    echo "<li><a href='#' data-toggle='modal' data-target='#logoutModal'>Logout<br>now</a></li>";
                                } else {
                                    echo "<li><a href='login.php'>B2B<br> login</a></li>";
                                }
                            ?>
                            <li><a href="#">Contact<br> us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container clearfix">
            <!--Logo-->
            <div class="logo float-left">
                <a href="index.html"><img src="images/web logo.jpg" alt="" title="" style="height: 86px;width: 288px;"></a>
            </div>
            
            <!--Right Col-->
            <div class="right-col float-right">
                <!-- Main Menu -->
                <nav class="main-menu navbar-expand-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="index.php">Home</a></li>
                                <li class="dropdown"><a href="#">Agri horti show</a>
                                    <ul>
                                        <li><a href="about-event.php">About the event</a></li>
                                        <li><a href="venue.php">Venue</a></li>
                                        <li><a href="conference-seminers.php">Conference and seminars</a></li>
                                        <li><a href="how-to-register.php">How to register</a></li>
                                        <li><a href="faq.php">FAQs</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Exhibitors</a>
                                    <ul>
                                        <li><a href="about.php">About</a></li>
                                        <li><a href="exhibitor-register.php">Join as exhibitor</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Agri horti sector</a>
                                    <ul>
                                        <li><a href="why-assam.php">Why Assam</a></li>
                                        <li class="dropdown"><a href="">About the sector</a>
                                            <ul>
                                                <li><a href="overview.php">Overview</a></li>
                                                <li><a href="assam-agriculture.php">Agriculture in Assam</a></li>
                                                <li><a href="horticulture-assam.php">Horticulture in Assam</a></li>
                                                <li><a href="food-processing.php">Food Processing in Assam</a></li>
                                                <li><a href="infrastructures.php">Supporting Infrastructures</a></li>
                                                <li><a href="sectors.php">Packaging</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="policy-section.php">Policy</a></li>
                                        <li><a href="key-contact.php">Key contacts</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Useful links</a>
                                    <ul>
                                        <li><a target="_blank" href="https://advantageassam.com/">Advantage Assam</a></li>
                                        <li><a target="_blank" href="https://assam.gov.in/">Government of Assam</a></li>
                                        <li><a target="_blank" href="https://diragri.assam.gov.in/">Directorate of Agriculture</a></li>
                                        <li><a target="_blank" href="https://dirhorti.assam.gov.in/">Director of Horticulture & Food Processing</a></li>
                                        <li><a target="_blank" href="https://agri-horti.assam.gov.in/">Department of Agriculture & Horticulture</a></li>
                                        <li><a target="_blank" href="https://easeofdoingbusinessinassam.in/">Ease of Doing Business in Assam</a></li>
                                        <li><a target="_blank" href="https://www.mofpi.nic.in/">Ministry of Food Processing</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Shelf of project</a></li>
                            </ul>
                        </div>
                </nav><!-- Main Menu End-->
            </div>
            
        </div>
    </div>
    <!--End Sticky Header-->
</header>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Hai Buddy! Are you realy went to logout.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
              </div>
            </div>
          </div>
        </div>