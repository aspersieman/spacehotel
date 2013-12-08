<div style="width: 600px;">
    <h1>Reservation Details</h1>
    <div class="paperl">
        <br />
        <strong>Customer Reservation Information</strong>
        <br />
        FirstName: <?php echo $page->reservation['firstname']; ?><br />
        LastName: <?php echo $page->reservation['lastname']; ?><br /> 
        Address: <?php echo $page->reservation['address']; ?><br />
        City: <?php echo $page->reservation['city']; ?><br />
        Zip: <?php echo $page->reservation['zip']; ?><br /> 
        Country: <?php echo $page->reservation['country']; ?><br />
        Email: <?php echo $page->reservation['email']; ?><br />
        Contact Number: <?php echo $page->reservation['contact']; ?><br />
        <br />
        <strong>Payment Information</strong><br />
        <!-- TODO -->
        <br>
        <br />
        <strong>Reservation Details</strong><br />
        Arrival Date: <?php echo $page->reservation['arrival_date']; ?><br /> 
        Departure Date: <?php echo $page->reservation['departure_date']; ?><br /> 
        Confirmation Code: <?php echo $page->reservation['confirmation_code']; ?><br />  
        Number of nights of stay: <?php echo $page->reservation['number_days']; ?>
        <br />
        <br />
        <strong>Rate Information</strong><br />
        Room Type: <?php echo $page->room['type']; ?><br />
        Room Rate: <?php echo $page->room['rate']; ?><br />
        Total Payable amount: <?php echo $page->reservation['amount_payable'];?>
    </div>
</div>
