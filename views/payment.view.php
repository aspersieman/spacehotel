<ul class='breadcrumb'>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>'>Home</a> </h2>
    </li>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>/pages/roomselect.php'>Select Room</a> </h2>
    </li>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>/pages/customerdetails.php'>Personal Details</a> </h2>
    </li>
    <li>
        <h2> <a>Pay Now</a> </h2>
    </li>
    <li>
    </li>
</ul>
<div class="leftother">
    <div class="l"> </div>
    <div class="r">
        <div class="right3">
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr"  method="post">
                <!-- the cmd parameter is set to _xclick for a Buy Now button -->
                <div class="reservation" style="margin-left: 176px; width: 400px;">
                <div class='reservation_heading'><h2>Reservation Details</h2></div>
                    <div style="margin-top: 14px;">
                        <label>Check In Date : </label> <?php echo $page->bookingArrivalDate; ?>
                        <br />
                        <label>Check Out Date : </label> <?php echo $page->bookingDepartureDate; ?>
                        <br />
                        <label>Adults : </label> <?php echo $page->bookingNumberAdults; ?>
                        <br />
                        <label>Child : </label> <?php echo $page->bookingNumberChildren; ?>
                        <br />
                        <label>Number of Rooms : </label> <?php echo $page->bookingNumberRooms; ?>
                        <br />
                        <label>Room ID : </label> <?php echo $page->bookingRoomId; ?>
                        <br />
                        <label>Number of nights : </label> <?php echo $page->bookingNumberDays; ?>
                        <br />
                        <label>Firstname : </label> <?php echo $page->customerFirstName; ?>
                        <br />
                        <label>Lastname : </label> <?php echo $page->customerLastName; ?>
                        <br />
                        <label>Address : </label> <?php echo $page->customerAddress; ?>
                        <br />
                        <label>City : </label> <?php echo $page->customerCity; ?>
                        <br />
                        <label>ZIP Code : </label> <?php echo $page->customerZip; ?>
                        <br />
                        <label>Country : </label> <?php echo $page->customerCountry; ?>
                        <br />
                        <label>Email : </label> <?php echo $page->customerEmail; ?>
                        <br />
                        <label>Contact Number : </label> <?php echo $page->customerContactNumber; ?>
                        <br />
                        <br />
                    </div>
                    <input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="business" value="test@test.com" />
                    <input type="hidden" name="item_name" value="<?php echo $page->roomType; ?>" />
                    <input type="hidden" name="item_number" value="<?php echo $page->bookingNumberRooms; ?>" />
                    <input type="hidden" name="amount" value="<?php echo $page->amountPayable; ?>" />
                    <input type="hidden" name="no_shipping" value="1" />
                    <input type="hidden" name="no_note" value="1" />
                    <input type="hidden" name="currency_code" value="USD" />
                    <input type="hidden" name="lc" value="USD" />
                    <input type="hidden" name="bn" value="PP-BuyNowBF" />
                    <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but23.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" style="margin-left: 157px;" />
                    <img alt="fdff" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1" />
                    <!-- Payment confirmed -->
                    <input type="hidden" name="return" value="<?php echo baseUrl();?>?r=paymentconfirm" />
                    <!-- Payment cancelled -->
                    <input type="hidden" name="cancel_return" value="<?php echo baseUrl();?>?r=paymentcancel" />
                    <input type="hidden" name="rm" value="2" />
                    <input type="hidden" name="custom" value="any other custom field you want to pass" />
                </form>
            </div> 
        </div>
    </div>
</div>
<div class="rightother"> </div>
