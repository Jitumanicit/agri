<?php
// Include config file
require_once "config/config.php";
 
// Define variables and initialize with empty values
$register_id = $interest = $expectation = $password = $confirm_password = "";
$register_id_err = $interest_err = $expectation_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate register_id
    if(empty(trim($_POST["register_id"]))){
        $register_id_err = "Please enter a register id.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tbl_users WHERE register_id = ? AND activation_status = 1";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_register_id);
            
            // Set parameters
            $param_register_id = trim($_POST["register_id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 0){
                    $register_id_err = "This register_id is not approved.";
                } else{
                    $register_id = trim($_POST["register_id"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate interest
    $input_interest = trim($_POST["interest"]);
    if(empty($input_interest)){
        $interest_err = "Please enter an interest.";     
    } else{
        $interest = $input_interest;
    }

    // Validate expectation
    $input_expectation = trim($_POST["expectation"]);
    if(empty($input_expectation)){
        $expectation_err = "Please enter an expectation.";     
    } else{
        $expectation = $input_expectation;
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($register_id_err) && empty($interest_err) && empty($expectation_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_b2b (register_id, interest, expectation, password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_register_id, $param_interest, $param_expectation, $param_password);
            
            // Set parameters
            $param_register_id = $register_id;
            $param_interest = $interest;
            $param_expectation = $expectation;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                header("refresh: 5");
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Thank You!","Registered Successfully","success");';
                echo '}, 300);</script>';
            } else{
                header("refresh: 5");
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Oops...","Not Registered","error");';
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
<?php include_once('header.php'); ?>
<div class="wrapper" style="max-width: 700px; padding: 20px; margin: 0 auto; box-shadow: 0 0 10px rgba(0,0,0,0.6);">
    <p><i class="fa fa-hand-o-right"></i>&nbsp;Those interested in B2B need to first register as Delegate <a href="register-for-sumit.php" style="color: red;">Register Now</a> and follow all the above steps.</p>
    <p><i class="fa fa-hand-o-right"></i>&nbsp;Upon receiving unique ID participant can register as B2B delegate using the relevant link and filling up additional information.</p>
    <p><i class="fa fa-hand-o-right"></i>&nbsp;B2B delegates to receive login details via mail.</p>
    <p><i class="fa fa-hand-o-right"></i>&nbsp;B2B delegate can access their dashboard using the login details provided to them.</p>
    <p><i class="fa fa-hand-o-right"></i>&nbsp;B2B delegates can view detailed list of other B2B participants, send requests and receive requests for B2B.</p>
    <p><i class="fa fa-hand-o-right"></i>&nbsp;Once complete B2B/B2G registration. Now login B2B/B2G portal<a href="login.php" style="color: red;"> Login Now</a></p>
</div>
<!--End Main Header -->
<div class="wrapper" style="max-width: 700px; padding: 20px; margin: 0 auto; margin-top: 30px; margin-bottom: 50px; box-shadow: 0 0 10px rgba(0,0,0,0.6);">
        <h2 style="text-align: center;">Register for B2B Portal</h2>
        <p style="margin-bottom: 20px; text-align: center;">Please fill this form to create an account</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($register_id_err)) ? 'has-error' : ''; ?>">
                <label>Registered Id</label>
                <input type="text" name="register_id" class="form-control" value="<?php echo $register_id; ?>">
                <span class="help-block"><?php echo $register_id_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($interest_err)) ? 'has-error' : ''; ?>">
                <label>Interest Sector in B2B</label>
                <select name="interest" class="form-control" value="<?php echo $interest; ?>">
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
                </select>
                <span class="help-block"><?php echo $interest_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($expectation_err)) ? 'has-error' : ''; ?>">
                <label>Expectation from B2B</label>
                <textarea name="expectation" class="form-control" value="<?php echo $expectation; ?>"></textarea>
                <span class="help-block"><?php echo $expectation_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" id="myPassword" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="alert alert-danger" role="alert">
              Please fill this form to submit your interest for participation
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-danger" value="Reset">
            </div>
        </form>
    </div>
    <?php include_once('footer.php'); ?>
