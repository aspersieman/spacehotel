<script src='public/js/ReservationCancelView.js' type='text/javascript'> </script>
<script src='public/js/ReservationCancelViewAction.js' type='text/javascript'> </script>
<script type='text/javascript'>
    var reservationcancelview = new ReservationCancelView();
</script>
<div class='reservation_heading'>
    <h2>Cancel Reservation</h2>
</div>
<i>To cancel your reservation, please enter the confirmation number sent to you via email</i>
<br/>
<br/>
<form id="form" name="cancelpage" method="post" action="pages/reservationcancelprocess.php">
    <label>Confirmation Number
        <input type="text" name="confirmation" id="ed" class="validate_string" />
        <br />
        <input type="checkbox" name="cancelpolicy" value="checkbox" />
        I agree with the <a rel="facebox" href="pages/cancelationpolicy.php">cancelation policy</a> of this hotel<br />
    </label>
    <input name="" type="submit" value="Cancel" id="SUBMIT" class="button" />
</form>
