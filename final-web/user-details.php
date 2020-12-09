<?php
    require_once('header.php');
    require_once('Database/user.php');
    require_once('sanitizer.php');
    $user = new User();
?>

<?php if (isset($_SESSION['email'])): 
    // signup-handler sanitizes when email is created, but we still sanitize here incase the hacker got around it
    $email = sanitize_input($_SESSION['email']);
    // should i use htmlentities here?
    $result = $user->fetchUserInfo($email); 

    // secure if a malicious script has been posted in the db
    $firstName = sanitizeDB_output($result['FirstName']);
    $lastName = sanitizeDB_output($result['LastName']);
    $password = sanitizeDB_output($result['Password']);
    $company = sanitizeDB_output($result['Company']);
    $address = sanitizeDB_output($result['Address']);
    $city = sanitizeDB_output($result['City']);
    $state = sanitizeDB_output($result['State']);
    $country = sanitizeDB_output($result['Country']);
    $postalCode = sanitizeDB_output($result['PostalCode']);
    $phone = sanitizeDB_output($result['Phone']);
    $fax = sanitizeDB_output($result['Fax']);
    $email = sanitizeDB_output($result['Email']);

?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Password</th>
                <th>Company</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Postal code</th>
                <th>Phone</th>
                <th>Fax</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            <?php
                echo('<tr>');
                    echo("<td>" . $firstName . "</td>");
                    echo("<td>" . $lastName . "</td>");
                    echo("<td>" . $password . "</td>");
                    echo("<td>" . $company . "</td>");
                    echo("<td>" . $address . "</td>");
                    echo("<td>" . $city . "</td>");
                    echo("<td>" . $state . "</td>");
                    echo("<td>" . $country . "</td>");
                    echo("<td>" . $postalCode . "</td>");
                    echo("<td>" . $phone . "</td>");
                    echo("<td>" . $fax . "</td>");
                    echo("<td>" . $email . "</td>");
                echo('</tr>');
            ?>
        </tbody>
    </table>

    <!-- 'data-toggle' along with 'href'  allows the button to trigger a modal -->
    <button class="btn btn-primary btn-md trigger-btn" data-toggle="modal" href="#modalEdit"> Edit Details</button>
        
<?php else:
        echo('UserDetails if session is NOT set');
?>
<?php endif; ?>

<!-- EDIT MODAL -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog"> <!-- enables the sizing and closing -->
        <div class="modal-content">

        <!-- Header and close button -->
        <div class="modal-header">
            <h4 class="modal-title">Edit details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>

        <!-- Input fields -->
        <div class="modal-body">
            <form action="./user-service.php" method="POST">

                <div class="form-group">
                    <label>First name</label>
                    <input type="text" class="form-control" placeholder="<?php echo($firstName); ?>" name="firstName" required="required" value="<?php echo($firstName); ?>">
                </div>

                <div class="form-group">
                    <label>Last name</label>
                    <input type="text" class="form-control" placeholder="<?php echo($lastName); ?>" name="lastName" required="required" value="<?php echo($lastName); ?>">
                </div>

                <div class="form-group">
                    <label>Old password</label>
                    <input type="text" class="form-control" placeholder="<?php echo($password); ?>" name="oldPassword" required="required">
                </div>

                <div class="form-group">
                    <label>New password</label>
                    <input type="text" class="form-control" placeholder="New password" name="newPassword" required="required">
                </div>

                <div class="form-group">
                    <label>Company</label>
                    <input type="text" class="form-control" placeholder="<?php echo($company); ?>" name="company" required="required"  value="<?php echo($lastName); ?>">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="<?php echo($address); ?>" name="address" required="required"  value="<?php echo($address); ?>">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="<?php echo($city); ?>" name="city" required="required"  value="<?php echo($city); ?>">
                </div>

                <div class="form-group">
                    <label>State</label>
                    <input type="text" class="form-control" placeholder="<?php echo($state); ?>" name="state" required="required" value="<?php echo($state); ?>">
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" placeholder="<?php echo($country); ?>" name="country" required="required"  value="<?php echo($country); ?>">
                </div>

                <div class="form-group">
                    <label>Postal code</label>
                    <input type="text" class="form-control" placeholder="<?php echo($postalCode); ?>" name="postalCode" required="required"  value="<?php echo($postalCode); ?>">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" placeholder="<?php echo($phone); ?>" name="phone" required="required"  value="<?php echo($phone); ?>">
                </div>

                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" class="form-control" placeholder="<?php echo($fax); ?>" name="fax" required="required"  value="<?php echo($fax); ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="<?php echo($email); ?>" name="newEmail" required="required"  value="<?php echo($email); ?>">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block btn-lg" name="action" value="updateUser"></button>
                </div>
            </form>
        </div>
    </div>
</div>
