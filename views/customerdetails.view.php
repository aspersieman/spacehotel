<link href="<?php echo APP_ROOT; ?>/public/css/customerdetails.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo APP_ROOT; ?>/public/js/library/jquery.watermarkinput.js"> </script>
<script src='<?php echo APP_ROOT; ?>/public/js/CustomerDetailsView.js' type='text/javascript'> </script>
<script src='<?php echo APP_ROOT; ?>/public/js/CustomerDetailsViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var customerdetailsview = new CustomerDetailsView();
</script>
<ul class='breadcrumb'>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>'>Home</a> </h2>
    </li>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>/pages/roomselect.php'>Select Room</a> </h2>
    </li>
    <li>
        <h2> <a>Personal Details</a> </h2>
    </li>
    <li>
    </li>
</ul>
<div style="display:none;"> </div>
<div class="mainwrapper">
    <div class="leftother">
        <div class="l">
        </div>
        <div class="r">
            <div class="right3">
                <div style="float: right; margin-right: 0px; color:#000000; font-family:Arial, Helvetica, sans-serif; width:489px;">
                    <div class='reservation_heading'><h2>Please enter your personal details</h2></div>
                    <form action="payment.php" method="post" style="margin-top: -31px;" name="personal">
                        <?php if(isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) { ?>
                            <ul class="err">
                            <?php foreach($_SESSION['ERRMSG_ARR'] as $message) { ?>
                                <li><?php echo $message; ?></li>
                            <?php } ?>
                            </ul>
                            <?php unset($_SESSION['ERRMSG_ARR']);
                        } 
                        session_write_close();
                        ?>
                        <br />
                        <input name="customerFirstName" type="text" class="ed validate_string constraint_capitalize" id="customerFirstName" placeholder="First Name" /> 
                        <input name="customerLastName" type="text" class="ed validate_string constraint_capitalize" id="customerLastName" placeholder="Last Name" />
                        <br />
                        <input name="customerAddress" type="text" class="ed validate_string" id="customerAddress" placeholder="Address" /> 
                        <input name="customerCity" type="text" class="ed validate_string" id="customerCity" placeholder="City" />
                        <br />
                        <input name="customerCountry" type="text" class="ed validate_string" id="customerCountry" placeholder="Country" />
                        <input name="customerZip" type="text" class="ed validate_string" id="customerZip" placeholder="ZIP Code" />
                        <span id="errmsg"> </span>
                        <br />
                        <input name="customerEmail" type="text" class="ed validate_email_required" id="customerEmail" placeholder="Email" /> 
                        <input name="customerEmailConfirm" type="text" class="ed validate_email_required" id="customerEmailConfirm" placeholder="Confirm Email" />
                        <br />
                        <input name="customerPassword" type="password" class="ed validate_string" id="customerPassword" placeholder="Password" /> 
                        <input name="customerContactNumber" type="text" class="ed validate_telephone_required" id="customerContactNumber" placeholder="Contact Number E.g. 123-456-7890" />
                        <span id="errmsg1">
                        </span>
                        <br />
                        <label>
                            <input type="checkbox" name="chbTermsAndConditions" id="chbTermsAndConditions" value="checkbox" />
                            <small>I agree to the <a rel="facebox" href="<?php echo APP_ROOT; ?>/pages/terms.php">terms and conditions</a> of this site</small>.
                        </label>
                        <br />
                        <p style="margin-top: 2px; margin-left: 1px;">
                        <img src="<?php echo APP_ROOT; ?>/pages/captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' title="All your base are belong to us">
                        <br>
                        <label for='message'>
                            <small>If you are a Human Enter the code above here :</small>
                        </label>
                        <br>
                        <input id="captchaCode" name="captchaCode" type="text" class="ed validate_string">
                        <br>
                        <small>If you cannot read the image click <a id='lnkRefreshCaptcha'>here</a> to load another</small>
                        </p>
                        <input name="but" type="submit" id="SUBMIT" class="button" value="Submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="rightother">
        <div class="reservation">
            <div class='reservation_heading'><h2>Reservation Details</h2></div>
            <div style="margin-top: 14px;">
                <label>Check In Date : </label> <?php echo $page->bookingArrivalDate; ?>
                <br />
                <label>Check Out Date : </label> <?php echo $page->bookingDepartureDate; ?>
                <br />
                <label>Adults : </label> <?php echo $page->bookingNumberAdults; ?>
                <br />
                <label>Children : </label> <?php echo $page->bookingNumberChildren; ?>
                <br />
                <label>Number of Rooms : </label> <?php echo $page->bookingNumberRooms; ?>
                <br />
                <label>Room ID : </label> <?php echo $page->bookingRoomId; ?>
                <br />
                <label>Number Of Nights : </label> <?php echo $page->bookingNumberDays; ?>
                <br />
                <br />
            </div>
        </div>
    </div>
</div>
