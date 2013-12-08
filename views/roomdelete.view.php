<?php if ($page->room) { ?>
    <form action="roomprocess.php" method="post">
    <input name="roomid" type="hidden" value="<?php echo $page->room["id"];?>" />
        Are you sure you want to delete this room?
        <div><input name="yes" type="submit" class="button" value="Yes" /><input name="no" type="submit" class="button" value="No" /></div>
    </form>
<?php } ?>
