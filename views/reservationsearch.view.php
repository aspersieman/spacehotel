<script src='<?php echo APP_ROOT; ?>/public/js/ReservationSearchView.js' type='text/javascript'> </script>
<script src='<?php echo APP_ROOT; ?>/public/js/ReservationSearchViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var reservationsearchview = new ReservationSearchView();
</script>
<div class="search">
    <h2>Search for Reservations</h2>
    <i>Please enter one or more search parameter below and then click search.</i>
    <form action="reservationsearchresults.php" id="frmReservationSearch" method="post">
        <table class="form_table">
            <tr class="form_row">
            <td>Customer First Name:</td><td> <input type="text" id="customerFirstName" name="customerFirstName" class="ed validate_string_optional" /></td>
            </tr>
            <tr class="form_row">
            <td>Customer Last Name:</td><td> <input type="text" id="customerLastName" name="customerLastName" class="ed validate_string_optional" /></td>
            </tr>
            <tr class="form_row">
            <td>Customer Email:</td><td> <input type="text" id="customerEmail" name="customerEmail" class="ed validate_email_optional" /></td>
            </tr>
            <tr class="form_row">
            <td>Arrival Date:</td><td> <input type="text" id="arrivalDate" name="arrivalDate" class="ed validate_date_optional" /></td>
            </tr>
            <tr class="form_row">
            <td>Departure Date:</td><td> <input type="text" id="departureDate" name="departureDate" class="ed validate_date_optional" /></td>
            </tr>
            <tr class="form_row">
            <td>Status: </td><td>
            <select id='cmbStatus' name='cmbStatus' class='ed validate_select_optional' >
                <option value="">All statuses</option>
                <option value="Active">Active</option>
                <option value="Out">Out</option>
            </select></td>
            </tr>
            <tr class="form_row">
            <td>Confirmation Code:</td><td> <input type="text" name="confirmationCode" class="ed validate_string_optional"></td>
            </tr>
            <tr class="form_row">
            <td>Room Type: </td><td>
            <select id='cmbRoomType' name='cmbRoomType' class='ed validate_select_optional' >
                <option value="">All rooms</option>
                <?php foreach ($page->rooms as $room) { ?>
                <option value="<?php echo $room["id"];?>"><?php echo $room["type"];?></option>
                <?php } ?>
            </select></td>
            </tr>
         </table>
        <input name="" id="btnSubmit" type="submit" value="Search" class="button" />
    </form>
</div>
