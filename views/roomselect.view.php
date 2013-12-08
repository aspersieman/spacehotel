<script src='../public/js/RoomSelectView.js' type='text/javascript'> </script>
<script src='../public/js/RoomSelectViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var roomselectview = new RoomSelectView();
</script>
<ul class='breadcrumb'>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>'>Home</a> </h2>
    </li>
    <li>
        <h2> <a>Select Room</a> </h2>
    </li>
    <li>
    </li>
</ul>
<div class='leftother'>
    <div class='l'>
    </div>
    <div class='r'>
        <div class='right3'>
            <div class='reservation_heading'><h2>Please enter the number of rooms and select the room type you would like to reserve below</h2></div>
            <form action='<?php echo APP_ROOT; ?>/pages/customerdetails.php' method='post' name='room'>
                <label style='margin-left: 119px;'>Enter number of rooms: </label>
                <input id='txtChar' type='text' name='bookingNumberRooms' class='ed validate_integer constraint_integer'>
                <span id='errmsg'>
                </span>
                <br />
                <br />
                <?php foreach($page->rooms as $room) {
                $roomId = $room['id'];
                $available = $room['quantity'] - $page->roomsQuantityReserved[$roomId]; ?>
                <div class='room_div'>
                    <div class='img_room'>
                        <img alt='Image not found' src='<?php echo APP_ROOT; ?>/public/img/photos/<?php echo $room["id"];?>.jpg' />
                    </div>
                    <div class='room_description'>
                        <span class='style5'>Avalable Rooms: <?php echo $available; ?>
                        </span>
                        <?php if ($available > 0) { ?>
                        <input name='bookingRoomId' type='checkbox' value='<?php echo $room['id']; ?>' />
                        <input id='SUBMIT' type='submit' name='btnReserve' value='Reserve' class='button'/>
                        <?php } ?>
                        <?php if ($available <= 0) { ?>
                        <span class='style5'>No rooms available.</span>
                        <?php } ?>
                        <br>
                        <span class='style5'>Room Type: <?php echo $room['type']; ?>
                        </span>
                        <br>
                        <span class='style5'>Room Rate: <?php echo $room['rate']; ?>
                        </span>
                        <br>
                        <span class='style5'>Max Child: <?php echo $room['max_child']; ?>
                        </span>
                        <br>
                        <input name='mchild' type='hidden' value='<?php echo  $room['max_child']; ?>' />
                        <input name='avail' type='hidden' value='<?php echo  $available; ?>' />
                        <span class='style5'>Max Adult: <?php echo  $room['max_adult']; ?>
                        </span>
                        <br>
                        <input name='madult' type='hidden' value='<?php echo  $room['max_adult']; ?>' />
                        <span class='style5'>Room Description: <?php echo  $room['description']; ?>
                        </span>
                    </div>
                </div>
                <div class='spacer' style='clear: both;'>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<div class='rightother'>
    <div class='reservation'>
        <div class='reservation_heading'><h2>Reservation Details</h2></div>
        <div style='margin-top: 14px;'>
            <label>Check In Date : </label> <?php echo  $page->bookingArrivalDate; ?>
            <br />
            <label>Check Out Date : </label> <?php echo  $page->bookingDepartureDate; ?>
            <br />
            <label>Adults : </label> <?php echo  $page->bookingNumberAdults; ?>
            <br />
            <label>Children : </label> <?php echo  $page->bookingNumberChildren; ?>
            <br />
            <label>Number Of Nights : </label> <?php echo $page->bookingNumberDays; ?>
        </div>
    </div>
</div>
<!-- vim:set foldmethod=marker -->
