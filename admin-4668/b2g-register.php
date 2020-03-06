<?php
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$fname = $mname = $lname = $designation = $organisation = $email = $mobile = $sector = $others = $org_turn = $organisation_profile = $organisation_address1 = $organisation_address2 = $city = $state = $pin = $country = "";
$fname_err = $mname_err = $lname_err = $designation_err = $organisation_err = $email_err = $mobile_err = $sector_err = $others_err = $org_turn_err = $organisation_profile_err = $organisation_address1_err = $organisation_address2_err = $city_err = $state_err = $pin_err = $country_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["email"])) && empty(trim($_POST["mobile"]))){
        $email_err = "Please enter a email.";
        $mobile_err = "Please enter mobile number.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_users WHERE email = ? AND mobile = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_mobile);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            $param_mobile = trim($_POST["mobile"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                    $mobile_err = "This mobile number is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                    $mobile = trim($_POST["mobile"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    //validate fname
    $input_fname = trim($_POST["fname"]);
    if(empty($input_fname)){
        $fname_err = "Please enter an first name.";     
    } else{
        $fname = $input_fname;
    }

    //validate mname
    $input_mname = trim($_POST["mname"]);
    if(empty($input_mname)){
        $mname_err = "Please enter an middle name.";     
    } else{
        $mname = $input_mname;
    }

    //validate lname
    $input_lname = trim($_POST["lname"]);
    if(empty($input_lname)){
        $lname_err = "Please enter an last name.";     
    } else{
        $lname = $input_lname;
    }
    //validate designation
    $input_designation = trim($_POST["designation"]);
    if(empty($input_designation)){
        $designation_err = "Please enter an designation.";     
    } else{
        $designation = $input_designation;
    }

    //validate designation
    $input_organisation = trim($_POST["organisation"]);
    if(empty($input_organisation)){
        $organisation_err = "Please enter an organisation.";     
    } else{
        $organisation = $input_organisation;
    }

    //validate sector
    $input_sector = trim($_POST["sector"]);
    if(empty($input_sector)){
        $sector_err = "Please enter an sector.";     
    } else{
        $sector = $input_sector;
    }

    //validate sector
    $input_others = trim($_POST["others"]);
    if(empty($input_others)){
        $others_err = "Please enter an others.";     
    } else{
        $others = $input_others;
    }

    //validate organisation turnover
    $input_org_turn = trim($_POST["org_turn"]);
    if(empty($input_org_turn)){
        $org_turn_err = "Please enter your Organisation turnover.";     
    } else{
        $org_turn = $input_org_turn;
    }

    //validate organisation profile
    $input_organisation_profile = trim($_POST["organisation_profile"]);
    if(empty($input_organisation_profile)){
        $organisation_profile_err = "Please enter your Organisation Profile.";     
    } else{
        $organisation_profile = $input_organisation_profile;
    }

    //validate organisation address1
    $input_organisation_address1 = trim($_POST["organisation_address1"]);
    if(empty($input_organisation_address1)){
        $organisation_address1_err = "Please enter your Organisation Address1.";    
    } else{
        $organisation_address1 = $input_organisation_address1;
    }

    //validate organisation address2
    $input_organisation_address2 = trim($_POST["organisation_address2"]);
    if(empty($input_organisation_address2)){
        $organisation_address2_err = "Please enter your Organisation Address2.";    
    } else{
        $organisation_address2 = $input_organisation_address2;
    }

    //validate organisation city
    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $city_err = "Please enter your city.";    
    } else{
        $city = $input_city;
    }

    //validate organisation state
    $input_state = trim($_POST["state"]);
    if(empty($input_state)){
        $state_err = "Please enter your state.";    
    } else{
        $state = $input_state;
    }

    //validate organisation pin
    $input_pin = trim($_POST["pin"]);
    if(empty($input_pin)){
        $pin_err = "Please enter your pin.";    
    } else{
        $pin = $input_pin;
    }

    //validate organisation pin
    $input_country = trim($_POST["country"]);
    if(empty($input_country)){
        $country_err = "Please enter your country.";    
    } else{
        $country = $input_country;
    }
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($email_err) && empty($mobile_err) && empty($sector_err) && empty($city_err) && empty($state_err) && empty($pin_err) && empty($country_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_users (fname, mname, lname, designation, organisation, email, mobile, sector, others, organisation_turnover, organisation_profile, address1, address2, city, state, pin, country, register_id, branch) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $param_fname, $param_mname, $param_lname, $param_designation, $param_organisation, $param_email, $param_mobile, $param_sector, $param_others, $param_organisation_turnover, $param_organisation_profile, $param_organisation_address1, $param_organisation_address2, $param_city, $param_state, $param_pin, $param_country,  $param_register_id, $param_branch);
            
            // Set parameters
            $param_fname = $fname;
            $param_mname = $mname;
            $param_lname = $lname;
            $param_designation = $designation;
            $param_organisation = $organisation;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_sector = $sector;
            $param_others = $others;
            $param_organisation_turnover = $org_turn;
            $param_organisation_profile = $organisation_profile;
            $param_organisation_address1 = $organisation_address1;
            $param_organisation_address2 = $organisation_address2;
            $param_city = $city;
            $param_state = $state;
            $param_pin = $pin;
            $param_country = $country;
            $random_number = rand(111,999);
            $param_register_id = "AHSXXXXXXXX$random_number";
            $param_branch = "b2g";
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // send SMS
                //$username = "mobisoftguwahati";
                //$password = "65a31c";
                //$sender   = "AIAHSW";
                //$messages = urlencode('Thank You!, Your name has has been Pre-Registered for the Event.Confirmation of participation subject to further approval. Your Unique ID No is '.$param_register_id.'');
                //$api_url  = "http://makemysms.in/api/sendsms.php?username=".$username."&password=".$password."&sender=".$sender."&mobile=".$param_mobile."&type=1&product=1&message=".$messages;
                //$output   = file_get_contents($api_url);
                // Redirect to login page
                header("refresh: 5");
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Thank You!","Registration successfully done for B2G portal. Unique ID No is '.$param_register_id.'","success");';
                echo '}, 300);</script>';
            } else{
                  header("refresh: 5");
                  echo '<script type="text/javascript">';
                  echo 'setTimeout(function () { swal("Oops...","Your Email or Mobile Number already used","error");';
                  echo '}, 300);</script>';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
}
?>
<?php require_once('header.php'); ?>
	<div class="container-fluid">
		<h2 style="text-align: center;">Register for B2G</h2><hr>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                        <label>First Name <span style="color: red;">*</span></label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                        <span class="help-block" style="color: red;"><?php echo $fname_err; ?></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group <?php echo (!empty($mname_err)) ? 'has-error' : ''; ?>">
                        <label>Middle Name</label>
                        <input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>">
                    </div> 
                </div>
                <div class="col-md-4">   
                    <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                        <label>Last Name <span style="color: red;">*</span></label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
                        <span class="help-block" style="color: red;"><?php echo $lname_err; ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($designation_err)) ? 'has-error' : ''; ?>">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" value="<?php echo $designation; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($sector_err)) ? 'has-error' : ''; ?>">
                        <label>Select Sector <span style="color: red;">*</span></label>
                        <select name="sector" id="sector" class="form-control" onchange="sectorTypes();" value="<?php echo $sector; ?>">
                            <option value="">Select One</option>
                            <option value="Academia">Academia</option>
                            <option value="Students">Students</option>
                            <option value="Government">Government</option>
                            <option value="Branding Company">Branding Company</option>
                            <option value="Agricultural Machinary & Equipment">Agricultural Machinary & Equipment</option>
                            <option value="Tractor/Harvester/Rotavator">Tractor/Harvester/Rotavator</option>
                            <option value="Fertilizers/ Bio-manure/ Liquid Fertilizer Mfrs">Fertilizers/ Bio-manure/ Liquid Fertilizer Mfrs</option>
                            <option value="Agriculture Seeds Manufacturers /Exporters">Agriculture Seeds Manufacturers /Exporters</option>
                            <option value="Agro Chemicals/Pesticides/Insecticides Mfrs">Agro Chemicals/Pesticides/Insecticides Mfrs</option>
                            <option value="Biotechnology /Tissue culture Laboratories">Biotechnology /Tissue culture Laboratories</option>
                            <option value="Irrigation/ Fertigation / Water Management Equipment">Irrigation/ Fertigation / Water Management Equipment</option>
                            <option value="Greenhouses/ Equipment Suppliers/ Agro Textiles">Greenhouses/ Equipment Suppliers/ Agro Textiles</option>
                            <option value="Precision Farming Products">Precision Farming Products</option>
                            <option value="Climat Control & Automation Equipment">Climat Control & Automation Equipment</option>
                            <option value="Planting Material /Seedling">Planting Material /Seedling</option>
                            <option value="Storage Equipment /Packaging Solutions">Storage Equipment /Packaging Solutions</option>
                            <option value="Dairy, Poultry & Live Stock Companies">Dairy, Poultry & Live Stock Companies</option>
                            <option value="Animal Husbandry/ Livestock Professional">Animal Husbandry/ Livestock Professional</option>
                            <option value="Livestock Breeding/ Housing/ Veterinary Products">Livestock Breeding/ Housing/ Veterinary Products</option>
                            <option value="Nodal Government Agencies / Department">Nodal Government Agencies / Department</option>
                            <option value="Farm Management Equipment">Farm Management Equipment</option>
                            <option value="Banks & Insurance Services">Banks & Insurance Services</option>
                            <option value="Soil Testing Equipment / Certification Companies">Soil Testing Equipment / Certification Companies</option>
                            <option value="Post Harvest Handling Equipment">Post Harvest Handling Equipment</option>
                            <option value="Agri Business Consultants / IT services">Agri Business Consultants / IT services</option>
                            <option value="Horticulture Supplies">Horticulture Supplies</option>
                            <option value="Floriculture & Nursery Industry">Floriculture & Nursery Industry</option>
                            <option value="Certification Agencies">Certification Agencies</option>
                            <option value="Horticulture Processing Technology">Horticulture Processing Technology</option>
                            <option value="Packaging Technology & Services">Packaging Technology & Services</option>
                            <option value="Grading & Sorting Machinery">Grading & Sorting Machinery</option>
                            <option value="Elevator / Conveyors / Rotary Separators">Elevator / Conveyors / Rotary Separators</option>
                            <option value="Cold chain Equipment for Perishable Produces">Cold chain Equipment for Perishable Produces</option>
                            <option value="Cold room & Refrigeration Appliances">Cold room & Refrigeration Appliances</option>
                            <option value="Perishable Cargo Handling">Perishable Cargo Handling</option>
                            <option value="Refrigerated Van & Trucks / Body Builders">Refrigerated Van & Trucks / Body Builders</option>
                            <option value="Cooling Pads & Heat Extractors">Cooling Pads & Heat Extractors</option>
                            <option value="Pack Houses / Warehousing / Surveyors">Pack Houses / Warehousing / Surveyors</option>
                            <option value="Digital Temperature Controller & Data Logger">Digital Temperature Controller & Data Logger</option>
                            <option value="Herbal & Medicinal Plants Exporters">Herbal & Medicinal Plants Exporters</option>
                            <option value="Herbal foods products">Herbal foods products</option>
                            <option value="Plasticulture Products">Plasticulture Products</option>
                            <option value="Quaculture Technology">Quaculture Technology</option>
                            <option value="R & D Organisations">R & D Organisations</option>
                            <option value="Vertical Farming Solutions">Vertical Farming Solutions</option>
                            <option value="Drones/ Satellite Sensing Equipment / Weather Forecast Solutions">Drones/ Satellite Sensing Equipment / Weather Forecast Solutions</option>
                            <option value="Hydroponics Farming Technologies">Hydroponics Farming Technologies</option>
                            <option value="Grain, Feed Millers & Food Manufactures">Grain, Feed Millers & Food Manufactures</option>
                            <option value="Grain Storage/ Silos/ Feed Milling Machinery">Grain Storage/ Silos/ Feed Milling Machinery</option>
                            <option value="Animal Nutrition Health Products/ Equipment">Animal Nutrition Health Products/ Equipment</option>
                            <option value="Plant Protection/ Pesticides / Insecticides / Nutrients">Plant Protection/ Pesticides / Insecticides / Nutrients</option>
                            <option value="Researchers / Students / Consultants">Researchers / Students / Consultants</option>
                            <option value="Agriculturists/ Agro Industries Corporations">Agriculturists/ Agro Industries Corporations</option>
                            <option value="Embassies/ Consulate">Embassies/ Consulate</option>
                            <option value="Trade Bodies/Industry Associations">Trade Bodies/Industry Associations</option>
                            <option value="Cooperative Societies / FPO's">Cooperative Societies / FPO's</option>
                            <option value="Agricultural products traders/ wholesaler">Agricultural products traders/ wholesaler</option>
                            <option value="Importer & Exporter of Agri Solutions">Importer & Exporter of Agri Solutions</option>
                            <option value="Scientists">Scientists </option>
                            <option value="Farmers">Farmers </option>
                            <option value="Workshop tools & equipment">Workshop tools & equipment </option>
                            <option value="Media-Magazines/papers/Books/Directories/ CD">Media -Magazines/papers/Books/Directories/ CD</option>
                            <option value="Media– Electronic Media">Media – Electronic Media</option>
                            <option value="Others">Others</option>
                        </select>
                        <span class="help-block" style="color: red;"><?php echo $sector_err; ?></span>
                    </div>
                </div>
            </div>
            <div id="others">
                <div class="form-group <?php echo (!empty($others_err)) ? 'has-error' : ''; ?>">
                    <label>Specify Sector</label>
                    <input type="text" name="others"class="form-control" value="<?php echo $others; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($organisation_err)) ? 'has-error' : ''; ?>">
                        <label>Organisation</label>
                        <input type="text" name="organisation" class="form-control" value="<?php echo $organisation; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="turnover">
                    <div class="form-group <?php echo (!empty($org_turn_err)) ? 'has-error' : ''; ?>">
                        <label>Organisation Turnover</label>
                        <input type="text" name="org_turn" class="form-control" value="<?php echo $org_turn; ?>">
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Email Id <span style="color: red;">*</span></label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="help-block" style="color: red;"><?php echo $email_err; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                        <label>Mobile Number <span style="color: red;">*</span></label>
                        <input type="number" name="mobile" class="form-control" value="<?php echo $mobile; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "12">
                        <span class="help-block" style="color: red;"><?php echo $mobile_err; ?></span>
                    </div>
                </div>
            </div>
            <div id="profile">
                <div class="form-group <?php echo (!empty($organisation_profile_err)) ? 'has-error' : ''; ?>">
                    <label>Organisation Profile</label>
                    <textarea name="organisation_profile" class="form-control" value="<?php echo $organisation_profile; ?>"></textarea>
                </div>
            </div>
            <div id="address">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($organisation_address1_err)) ? 'has-error' : ''; ?>">
                        <label>Organisation Address Line 1</label>
                        <textarea name="organisation_address1" class="form-control" value="<?php echo $organisation_address1; ?>"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($organisation_address2_err)) ? 'has-error' : ''; ?>">
                        <label>Organisation Address Line 2</label>
                        <textarea name="organisation_address2" class="form-control" value="<?php echo $organisation_address2; ?>"></textarea>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                        <label>City <span style="color: red;">*</span></label>
                        <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                        <span class="help-block" style="color: red;"><?php echo $city_err; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                        <label>State <span style="color: red;">*</span></label>
                        <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                        <span class="help-block" style="color: red;"><?php echo $state_err; ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($pin_err)) ? 'has-error' : ''; ?>">
                        <label>Pin/Zip <span style="color: red;">*</span></label>
                        <input type="text" name="pin" class="form-control" value="<?php echo $pin; ?>">
                        <span class="help-block" style="color: red;"><?php echo $pin_err; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo (!empty($country_err)) ? 'has-error' : ''; ?>">
                        <label>Country <span style="color: red;">*</span></label>
                        <input type="text" name="country" class="form-control" value="<?php echo $country; ?>">
                        <span class="help-block" style="color: red;"><?php echo $country_err; ?></span>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger" role="alert">
              Disclaimer: Confirmation of participation is subjected to further approval
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-danger" value="Reset">
            </div>
        </form>
	</div>
	<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script>
        function sectorTypes(){
            var a = $('#sector').val();
            if('Students'==a || 'Academia'==a){
                $('#turnover').hide();
                $('#profile').hide();
                $('#address').hide();
            } else{
                $('#turnover').show();
                $('#profile').show();
                $('#address').show();
            }
            var b = $('#sector').val();
            if ('Others'==b) {
                $('#others').show();
            } else{
                $('#others').hide();
            }
        }
        $(document).ready(function(){
            $('#others').hide();
        });
    </script>
</body>

</html>
