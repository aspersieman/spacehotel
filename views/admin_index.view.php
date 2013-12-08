<script src='<?php echo APP_ROOT; ?>/public/js/AdminIndexView.js' type='text/javascript'> </script>
<script src='<?php echo APP_ROOT; ?>/public/js/AdminIndexViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var adminindexview = new AdminIndexView();
    <?php if ($page->view == "search") { ?>
        $(document).ready(function() {
            adminindexview.viewReservationSearch();
        });
    <?php } ?>
</script>
<ul class='breadcrumb'>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>'>Home</a> </h2>
    </li>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>/pages/admin_index.php'>Admin</a> </h2>
    </li>
    <li>
    </li>
</ul>
<div class="mainwrapper">
    <div class="leftother">
        <div class="l">
            <div style="margin-top: 225px; margin-right: 10px;">
                <?php if ($page->userPosition == "admin") { ?>
                    <a href="#1" data-ref="slider1" class="cross-link">Reservations</a> <br />
                    <a href="#2" data-ref="slider1" class="cross-link">Rooms</a> <br />
                    <a href="#3" data-ref="slider1" class="cross-link">Inventory</a> <br />
                    <a href="logout.php">Logout</a> <br />
                <?php } elseif ($page->userPosition == "clerk") { ?>
                    <a href="#1" data-ref="slider1" class="cross-link">Reservations</a> <br />
                    <a href="logout.php">Logout</a> <br />
                <?php } ?> 
            </div>
        </div>
        <div class="r">
            <div class="right3">
                <div class="slider-wrap">
                    <div id='slider1' class="coda-slider">
                        <div class="panel" title="Panel 1">
                            <div class="wrapper">
                                <div class="view">
                                    <div class='page_heading'><h2>Reservations</h2></div>
                                    <?php if (count($page->reservations) > 0) { ?>
                                    <table class="datatable" cellspacing="0">
                                        <tr>
                                            <td class="column_header">Name</td>
                                            <td class="column_header">Arrival</td>
                                            <td class="column_header">Departure</td>
                                            <td class="column_header">Room Type </td>
                                            <td class="column_header">No. of Nights</td>
                                            <td class="column_header">Action</td>
                                        </tr>
                                        <?php foreach($page->reservations as $reservation) { ?>
                                        <tr>
                                            <td class="contacts"><?php echo $reservation['firstname'] . ' ' . $reservation['lastname']; ?></td>
                                            <td class="contacts"><?php echo $reservation['arrival_date']; ?></td>
                                            <td class="contacts"><?php echo $reservation['departure_date']; ?></td>
                                            <td class="contacts">
                                                <?php 
                                                $roomId = $reservation['room_id'];
                                                $room = R::getRow("SELECT * FROM room WHERE id = ?", Array($roomId));
                                                echo $room['type']; 
                                                ?>
                                            </td>
                                            <td class="contacts"><?php echo $reservation['number_days']; ?></td>
                                            <td class="contacts"><a href='checkout.php?resid=<?php echo $reservation["id"];?>'>Check Out</a> | <a rel="facebox" href='reservationview.php?resid=<?php echo $reservation["id"];?>'>View</a></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                    <?php } else { ?>
                                    No reservations are currently active
                                    <?php } ?>
                                    <br />
                                    <a rel="facebox" id="lnkReservationSearch" href="reservationsearch.php">Search</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel" title="Panel 2">
                            <div class="wrapper">
                                <div class="view">
                                    <div class='page_heading'><h2>Rooms</h2></div>
                                    <table class="datatable" cellspacing="0">
                                        <tr>
                                            <td class="column_header">Type</td>
                                            <td class="column_header">Rate</td>
                                            <td class="column_header">Descripton</td>
                                            <td class="column_header">Quantity</td>
                                            <td class="column_header">Action</td>
                                        </tr>
                                        <?php foreach($page->rooms as $room) { ?>
                                        <tr>
                                            <td><?php echo $room['type'];?></td>
                                            <td><?php echo $room['rate'];?></td>
                                            <td><?php echo $room['description'];?></td>
                                            <td><?php echo $room['quantity']; ?></td>
                                            <td>
                                                <a rel="facebox" href='roomedit.php?id=<?php echo $room["id"]; ?>'>Edit</a> | 
                                                <a rel="facebox" href='roomdelete.php?id=<?php echo $room["id"]; ?>'>Delete</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                    <br />
                                    <a rel="facebox" href="roomadd.php">Add Room </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel" title="Panel 3">
                            <div class="wrapper">
                                <div class="view">
                                    <div class='page_heading'><h2>Inventory</h2></div>
                                    <table class="datatable" cellspacing="0">
                                        <?php foreach($page->rooms as $room) {
                                            $roomId = $room["id"];
                                            $roomType = $room["type"];
                                            $quantityReserved = R::getRow("SELECT SUM(quantity_reserve) FROM room_inventory WHERE status != :status AND room_id = :roomId", Array(":status" => 'Out', ":roomId" => $roomId));
                                            $quantityReservedSum = (isset($quantityReserved['SUM(quantity_reserve)'])) ? $quantityReserved['SUM(quantity_reserve)'] : 0; ?>
                                            <tr><td class="column_header"><?php echo $roomType; ?> reservations:</td><td> <?php echo $quantityReservedSum; ?></td></tr>
                                        <?php } ?>
                                    </table>
                                    </br>
                                    <table class="datatable" cellspacing="0">
                                        <tr>
                                            <td class="column_header">Arrival</td>
                                            <td class="column_header">Departure</td>
                                            <td class="column_header">Quantity Reserve</td>
                                            <td class="column_header">Room Type</td>
                                            <td class="column_header">Confirmation Number</td>
                                            <td class="column_header">Status</td>
                                        </tr>
                                        <?php foreach($page->roomInventory as $inventory) { ?>
                                        <tr>
                                            <td><?php echo $inventory['arrival_date']; ?></td>
                                            <td><?php echo $inventory['departure_date']; ?></td>
                                            <td><?php echo $inventory['quantity_reserve']; ?></td>
                                            <td> <?php 
                                                $roomId = $inventory['room_id'];
                                                $room = R::getRow("SELECT * FROM room WHERE id = ?", Array($roomId));
                                                echo $room["type"]; 
                                            ?>
                                            </td>
                                            <td><?php echo $inventory['confirmation_code'];?></td>
                                            <td><?php echo $inventory['status'];?></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rightother"> </div>
</div>
