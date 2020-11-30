<?php
    // Includer header which also starts session
    require_once('Source/NavigationBar.php');
    // Include modals
    require_once('Modals/LoginModal.php');

    // If posted category cookie 
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        setcookie('category', $category, time() + 86400);
    } else {
        // if cookie is set and no cookie is posted
        if (isset($_COOKIE['category'])) {
            $category = $_COOKIE['category'];
        } else {
            // Default category
            $category = 'Home';
            echo('no category cookie');
        }
    };
    
    // Serving the different views
    switch ($category) {

        case 'artists':
            require_once('Source/ArtistView.php');
        break;

        case 'albums':
            require_once('Source/UserDetails.php');
            echo('Albums');
        break;

        case 'tracks':
            echo('Tracks');
        break;
        
        case 'cart':
            echo('Cart');
        break;
        
        case 'account':
            echo('Account');
        break;

        case 'checkout':
            echo('Checkout');
        break;
        
        case 'home':
            echo('Home');
        break;

    }

?>  
    
</body>
</html>