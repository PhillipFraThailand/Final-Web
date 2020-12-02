<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/custom.css">

    <!-- Scripts -->
    <script defer src="bootstrap/js/jquery-3.5.1.js"></script>
    <script defer src="bootstrap/js/bootstrap.min.js"></script>
    <title>Track Provider</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <!-- Burgermenu appears on small screen  -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo  -->
        <img src="Images/microphone.png" alt="Images/node.png" class="img-responsive">
        <a class="navbar-brand" href="#">Track Providers</a>

        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto" id="navbarSupportedContent">

                <form action="http://localhost:8080/final-web/" method="GET">
                    <button type="submit" class="btn btn-light">Home</button>
                </form>

                <form action="http://localhost:8080/final-web/artists.php" method="GET">
                    <button type="submit" class="btn btn-light">Artists</button>
                </form>

                <form action="http://localhost:8080/final-web/albums.php" method="GET">
                    <button type="submit" class="btn btn-light" value="Submit">Albums</button>
                </form>

                <form action="http://localhost:8080/final-web/tracks.php" method="GET">
                    <button type="submit" class="btn btn-light" >Tracks</button>
                </form>

                <form action="http://localhost:8080/final-web/cart.php" method="GET">
                    <button type="submit" class="btn btn-light" >Cart</button>
                </form>

                <!-- Login / Account tab-->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">

                    <!-- Logged in  MAKE INTO A BUTTON LATER WHEN U CAN TEST IT-->
                    <?php if (isset($_SESSION['userId'])): ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account
                                Session is set
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Details</a>
                                <a class="dropdown-item" href="#">Sign out</a>
                            </div>
                    <?php endif; ?>

                    <!-- !Logged in require the loginModal-->
                    <?php if (!isset($_SESSION['userId'])): //require_once('login/login-modal.php') ?>
	                    <!-- Button to Trigger Modal -->
                            <button href="#modalLogin" class="btn btn-light trigger-btn" data-toggle="modal">Sign in</a>
                    <?php endif; ?>
                    </li>
                </ul>

            </div>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn bg-light my-2 my-sm-0"  type="submit">Search</button>
            </form>
        </div>
    </nav>


<!-- LOGIN MODAL -->
<div id="modalLogin" class="modal fade">
	<div class="modal-dialog modal-login"> <!-- enables the sizing and closing -->
		<div class="modal-content">

            <!-- Header and close button -->
			<div class="modal-header">
				<h4 class="modal-title">User login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

			<!-- Input fields -->
			<div class="modal-body">
				<form action="./login-handler.php" method="POST">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="email" name="email" required="required">
                    </div>

					<div class="form-group">
						<input type="password" class="form-control" placeholder="password" name="password" required="required">
                    </div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
					</div>
				</form>
            </div>

            <!-- Sign up button -->
			<div class="modal-footer">
				<a href="" data-toggle="modal" data-target="#modalSignup">Sign up</a>
			</div>
		</div>
	</div>
</div>

<!-- SIGN UP MODAL -->
<div class="modal fade" id="modalSignup">
    <div class="modal-dialog"> <!-- enables the sizing and closing -->
        <div class="modal-content">

            <!-- Header and close button -->
            <div class="modal-header">
                <h4 class="modal-title">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <!-- Input fields -->
                <form action="./signup-handler.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First name" name="firstName" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last name" name="lastName" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Password" name="password" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Company" name="company" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Address" name="address" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="City" name="city" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="State" name="state" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Country" name="country" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Postal code" name="postalCode" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone number" name="phone" required="required">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Fax" name="fax" required="required">
                    </div>
                    <!-- Button -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Register"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
