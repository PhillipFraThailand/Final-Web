<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Styles -->
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/custom.css">
    
    <!-- Scripts -->
    <script defer src="Javascript/jquery-3.5.1.js"></script>
    <script defer src="bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <title>Track Provider</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <!-- Burgermeny collapse. Appears when small screen -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Brand / logo  -->
        <img src="Images/microphone.png" alt="Images/node.png" class="img-responsive">
        <a class="navbar-brand" href="#">Track Providers</a>

        <!-- Navbar items -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">         

            <!-- Remember mr-auto to make searchbar go all the way to the left -->
            <div class="navbar-nav mr-auto" id="navbarSupportedContent">
                <a class="nav-link" href="http://localhost:8080/final-web/?category=home"> Home <span class="sr-only">(current)</span></a>
                <a class="nav-link" href="http://localhost:8080/final-web/?category=artists">Artists</a>
                <a class="nav-link" href="http://localhost:8080/final-web/?category=albums">Albums</a>
                <a class="nav-link" href="http://localhost:8080/final-web/?category=tracks">Tracks</a>
                <a class="nav-link" href="http://localhost:8080/final-web/?category=cart">Cart</a>

                <!-- Login / Account tab-->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">

                    <!-- Logged in -->
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
                    <?php if (!isset($_SESSION['userId'])): require_once('Modals/LoginModal.php') ?>
	                    <!-- Button to Trigger Modal -->
                            <a href="#myModal" class="nav-link trigger-btn" data-toggle="modal">Sign in</a>
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
