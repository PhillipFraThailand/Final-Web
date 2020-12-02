<?php
    // Includer header which also starts session
    require_once('header.php');

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
    
    // Body
    switch ($category) {
// switch names and category get parameter to users/{id} etc
        case 'artists':
            require_once('artist-view.php');
        break;

        case 'albums':
            require_once('user-account.php');
            echo('Index Echo.');
        break;

        case 'tracks':
            echo('Tracks');
        break;
        
        case 'cart':
            echo('Cart');
        break;
        
        case 'user-account':
            echo('user-account');
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