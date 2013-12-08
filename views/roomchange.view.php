<script src='<?php echo APP_ROOT; ?>/public/js/RoomChangeView.js' type='text/javascript'> </script>
<script src='<?php echo APP_ROOT; ?>/public/js/RoomChangeViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var roomchangeview = new RoomChangeView();
</script>
<div class="mainwrapper">
    <div class="leftother">
        <div class="l"> </div>
        <div class="r">
            <div class="right3">
                <form action="customerdetailsedit.php" method="post" name="room">
                    <input name="arrivalDate" type="hidden" value="<?php echo $page->arrivalDate; ?>" />
                    <input name="departureDate" type="hidden" value="<?php echo $page->departureDate; ?>" />
                    <input name="numberAdults" type="hidden" value="<?php echo $page->numberAdults; ?>" />
                    <input name="numberChildren" type="hidden" value="<?php echo $page->numberChildren; ?>" />
                    <input name="confirmationCode" type="hidden" value="<?php echo $page->confirmationCode; ?>" />
                    <label style="margin-left: 119px;">Number of rooms: </label>
                    <input id="numberRooms" type="text" name="numberRooms" class="ed validate_integer constraint_integer">
                    <br />
                    <br />
                    <?php foreach ($page->rooms as $room) {
                        $roomId = $room["id"];
                        $quantityReservedRow = R::getRow(
                            "SELECT SUM(quantity_reserve) FROM room_inventory where arrival_date <= :arrivalDate AND departure_date >= :departureDate AND room_id = :roomId",
                            Array(
                                ":arrivalDate" => $page->arrivalDate,
                                ":departureDate" => $page->departureDate,
                                ":roomId" => $page->roomId)
                            );
                        $quantityReserved = $quantityReservedRow["SUM(quantity_reserve)"];
                        $quantityAvailable = $room['quantity'] - $quantityReserved; ?>
                        <div class='room_div'>
                            <div style="float: left; width: 100px; margin-left: 19px;">
                            <img width=92 height=72 alt='Image not found' src="<?php echo IMG_PATH; ?>photos/<?php echo $room["id"];?>.jpg">
                            </div>
                            <div style="width: 575px; margin-left: 120px;">
                            <span class="style5">Available Rooms: <?php echo (($quantityAvailable < 0) ? 0 : $quantityAvailable); ?></span>
                            <?php if ($quantityAvailable > 0) { ?>
                            <input name="roomId" type="checkbox" value="<?php echo $room["id"]; ?>" />
                            <input type="submit" name="btnReserve" class="button" value="Reserve" />
                            <?php }
                            if ($quantityAvailable <= 0){ ?>
                                <span class="warning">No rooms available</span>
                            <?php }	?>
                            <br>
                            <span class="style5">Room Type: <?php echo $room['type']; ?></span>
                            <br>
                            <span class="style5">Room Rate: <?php echo $room['rate']; ?></span>
                            <br>
                            <span class="style5">Room Description: <?php echo $room['description']; ?></span>
                            </div>
                        </div>
                    <?php } ?> 
                    <input type="hidden" name="result" id="result" />
                </form>
            </div>
        </div>
    </div>
    <div class="rightother">
        <div class="reservation">
            <div class='reservation_heading'><h2>Reservation Details</h2></div>
            <label>Check In Date : </label> <?php echo $page->arrivalDate; ?>
            <br />
            <label>Check Out Date : </label> <?php echo $page->departureDate; ?>
            <br />
            <label>Adults : </label> <?php echo $page->numberAdults; ?>
            <br />
            <label>Child : </label> <?php echo $page->numberChildren; ?>
            <br />
            <br />
        </div>
    </div>
</div>
