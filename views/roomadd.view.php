<h2>Add New Room</h2>
<form action="roomprocess.php" method="post" name="roomadd">
    <input name="roomadd" type="hidden" value="roomadd" />
    RoomType<br />
    <input name="type" type="text" class="ed validate_string" /><br />
    Rate<br />
    <input name="rate" type="text" id="rate" class="ed validate_float" /><br />
    Quantity<br />
    <input name="quantity" type="text" id="quantity" class="ed validate_integer" /><br />
    Description<br />
    <input name="description" type="text" class="ed validate_string" /><br />
    <input type="submit" name="Submit" value="Save" class="button" id="btnAdd" />
</form>

