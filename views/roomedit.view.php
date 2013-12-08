<?php if ($page->room) { ?>
    <h2>Edit Room ID: <?php echo $page->room["id"];?></h2>
    <form action="roomprocess.php" method="post">
        <br>
        <input type="hidden" name="roomid" value="<?php echo $page->room['id'];?>">
        Room Type: <input type="text" class="ed validate_string" name="roomtype" value="<?php echo $page->room['type']; ?>">
        <br>
        Rate: <input type="text" name="rate" class="ed validate_float" value="<?php echo $page->room['rate'];?>">
        <br>
        Description: <input type="text" name="description" class="ed validate_string" value="<?php echo $page->room['description'];?>">
        <br>
        Quantity: <input type="text" name="quantity" class="ed validate_integer" value="<?php echo $page->room['quantity'];?>">
        <br>
        <input name="" type="submit" value="Save" class="button" />
    </form>
<?php } ?>
