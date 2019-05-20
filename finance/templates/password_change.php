<form action="password_change.php" method="POST">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="oldpassword" placeholder="Old password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="New Password" type="password"/>
        </div>
         <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="Confirm New Password" type="password"/>
        </div>
	    <div class="form-group">
            <button type="submit" class="btn btn-default">Change Password</button>
        </div>
    </fieldset>
</form>
