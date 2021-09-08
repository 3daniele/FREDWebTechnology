<?php

session_start();

require_once 'config.php';
require_once ROOT_PATH . 'inc/globals.php';
require_once ROOT_PATH . 'inc/functions.php';

require_once ROOT_PATH . 'classes/DB.php';
require_once ROOT_PATH . 'classes/User.php';
require_once ROOT_PATH . 'classes/Product.php';
require_once ROOT_PATH . 'classes/CategoryItem.php';
require_once ROOT_PATH . 'classes/Category.php';
require_once ROOT_PATH . 'classes/Img.php';
require_once ROOT_PATH . 'classes/Cart.php';
require_once ROOT_PATH . 'classes/Wishlist.php';
//require_once ROOT_PATH . 'classes/ProductCategory.php';

require_once ROOT_PATH . 'public/auth/pages/login-action.php';


?>