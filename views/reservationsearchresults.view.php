<script src='<?php echo APP_ROOT; ?>/public/js/ReservationSearchResultsView.js' type='text/javascript'> </script>
<script src='<?php echo APP_ROOT; ?>/public/js/ReservationSearchResultsViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var reservationsearchresultsview = new ReservationSearchResultsView();
</script>
<ul class='breadcrumb'>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>'>Home</a> </h2>
    </li>
    <li>
        <h2> <a href='<?php echo APP_ROOT; ?>/pages/admin_index.php?view=search#1'>Search Reservations</a> </h2>
    </li>
    <li>
        <h2> <a>Search Results</a> </h2>
    </li>
    <li>
    </li>
</ul>
<div class="view_wide">
    <div class='page_heading'><h2>Reservation Search Results</h2></div>
    <?php if (count($page->reservations) > 0) { ?>
    <table class="datatable" cellspacing="0">
        <tr>
            <td class="column_header">First Name</td>
            <td class="column_header">Last Name</td>
            <td class="column_header">Email</td>
            <td class="column_header">Arrival</td>
            <td class="column_header">Departure</td>
            <td class="column_header">Room Type </td>
            <td class="column_header">Status </td>
            <td class="column_header">Confirmation Code </td>
            <td class="column_header">No. of Nights</td>
            <td class="column_header">Action</td>
        </tr>
        <?php foreach($page->reservations as $reservation) { ?>
        <tr>
            <td class="contacts"><?php echo $reservation['firstname']; ?></td>
            <td class="contacts"><?php echo $reservation['lastname']; ?></td>
            <td class="contacts"><?php echo $reservation['email']; ?></td>
            <td class="contacts"><?php echo $reservation['arrival_date']; ?></td>
            <td class="contacts"><?php echo $reservation['departure_date']; ?></td>
            <td class="contacts">
                <?php 
                $roomId = $reservation['room_id'];
                $room = R::getRow("SELECT * FROM room WHERE id = ?", Array($roomId));
                echo $room['type']; 
                ?>
            </td>
            <td class="contacts"><?php echo $reservation['status']; ?></td>
            <td class="contacts"><?php echo $reservation['confirmation_code']; ?></td>
            <td class="contacts"><?php echo $reservation['number_days']; ?></td>
            <td class="contacts"><a rel="facebox" href='reservationview.php?resid=<?php echo $reservation["id"];?>'>View</a></td>
        </tr>
        <?php } ?>
    </table>
    <?php } else { ?>
    No reservations found
    <?php } ?>
    <br />
</div>

