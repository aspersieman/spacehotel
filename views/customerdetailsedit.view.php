<script src='<?php echo APP_ROOT; ?>/public/js/CustomerDetailsEditView.js' type='text/javascript'> </script>
<script src='<?php echo APP_ROOT; ?>/public/js/CustomerDetailsEditViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var customerdetailseditview = new CustomerDetailsEditView();
</script>
<div class="mainwrapper">
    <div class="leftother">
            <div class="right3">
                <div style="float: left; margin-left: 160px; color:#000000; font-family:Arial, Helvetica, sans-serif; width:489px;">
                    <div class='reservation_heading'><h2>Please enter your personal details</h2></div>
                    <form action="customerdetailssave.php" method="post" style="margin-top: -31px;" name="personal">
                          <input name="arrivalDate" type="hidden" value="<?php echo $page->arrivalDate; ?>" />
                          <input name="departureDate" type="hidden" value="<?php echo $page->departureDate; ?>" />
                          <input name="numberAdults" type="hidden" value="<?php echo $page->numberAdults; ?>" />
                          <input name="numberChildren" type="hidden" value="<?php echo $page->numberChildren; ?>" />
                          <input name="numberRooms" type="hidden" value="<?php echo $page->numberRooms; ?>" />
                          <input name="roomId" type="hidden" value="<?php echo $page->roomId; ?>" />
                          <input name="confirmationCode" type="hidden" value="<?php echo $page->confirmationCode; ?>" />
                          <input name="numberDays" type="hidden" value="<?php echo $page->numberDays; ?>" />
                        <?php if(isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) { ?>
                            <ul class="err">
                            <?php foreach($_SESSION['ERRMSG_ARR'] as $message) { ?>
                                <li><?php echo $message; ?></li>
                            <?php } ?>
                            </ul>
                            <?php unset($_SESSION['ERRMSG_ARR']);
                            } ?>
                        <br />
                        <input name="customerFirstName" value="<?php echo $page->reservation["firstname"];?>" type="text" class="ed validate_string constraint_capitalize" id="customerFirstName" placeholder="First Name" /> 
                        <input name="customerLastName" value="<?php echo $page->reservation["lastname"];?>" type="text" class="ed validate_string constraint_capitalize" id="customerLastName" placeholder="Last Name" />
                        <br />
                        <input name="customerAddress" value="<?php echo $page->reservation["address"];?>" type="text" class="ed validate_string" id="customerAddress" placeholder="Address" /> 
                        <input name="customerCity" value="<?php echo $page->reservation["city"];?>" type="text" class="ed validate_string" id="customerCity" placeholder="City" />
                        <br />
                        <input name="customerCountry" value="<?php echo $page->reservation["country"];?>" type="text" class="ed validate_string" id="customerCountry" placeholder="Country" />
                        <input name="customerZip" value="<?php echo $page->reservation["zip"];?>" type="text" class="ed validate_string" id="customerZip" placeholder="ZIP Code" />
                        <br />
                        <input name="customerEmail" value="<?php echo $page->reservation["email"];?>" type="text" class="ed validate_email_required" id="customerEmail" placeholder="Email" /> 
                        <input name="customerEmailConfirm" value="<?php echo $page->reservation["email"];?>" type="text" class="ed validate_email_required" id="customerEmailConfirm" placeholder="Confirm Email" />
                        <br />
                        <input name="customerPassword" type="password" class="ed validate_string" id="customerPassword" placeholder="Password" /> 
                        <input name="customerContactNumber" value="<?php echo $page->reservation["contact"];?>" type="text" class="ed validate_telephone_required" id="customerContactNumber" placeholder="Contact Number E.g. 123-456-7890" />
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
    <div class="rightother">
        <div class="reservation">
            <div class='reservation_heading'><h2>Reservation Details</h2></div>
            <div style="margin-top: 14px;">
                <label>Check In Date : <?php echo $page->arrivalDate; ?>
                </label>
                <br />
                <label>Check Out Date : <?php echo $page->departureDate; ?>
                </label>
                <br />
                <label>Adults : <?php echo $page->numberAdults; ?>
                </label>
                <br />
                <label>Child : <?php echo $page->numberChildren; ?>
                </label>
                <br />
                <label>Number of Rooms : <?php echo $page->numberRooms; ?>
                </label>
                <br />
                <label>Room ID : <?php echo $page->roomId; ?>
                </label>
                <br />
                <label>Number Of Nights : <?php echo $page->reservation["number_days"]; ?>
                </label>
                <br />
                <br />
            </div>
        </div>
    </div>
</div>
