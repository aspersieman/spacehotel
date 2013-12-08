<div class="login">
    <div class='reservation_heading'>
        <h2>Login</h2>
    </div>
    <form id="form1" name="login" method="post" action="<?php echo APP_ROOT; ?>/pages/login.php">
        <label>User Name
            <input type="text" class="ed validate_string" name="user" />
        </label>
        <p>
        <label>Password
            <input type="password" class="ed validate_string" name="password" />
        </label>
        </p>
        <a rel="facebox" href="<?php echo APP_ROOT; ?>/pages/recover.php">Forgot Password? </a>
        <p>
        <label>
            <input type="submit" name="Submit" id="SUBMIT" class="button" value="login" />
        </label>
        </p>
    </form>
</div>
