<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('contact-us', 'Users::contactus');

// Migration
$routes->get('migration', 'Migration::index');

// Seeding
$routes->get('seeder/(:any)', 'Seeder::run/$1');

// Login is required before accessing
$routes->group('product', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->add('/', 'Product::index');
    $routes->add('view/(:num)', 'Product::singleProduct/$1');
    //Exception for cart module user-is-logged-in validation, as the self-defined auth is defined in function
    $routes->add('addToCart', 'Product::addToCart');
});

// Check user-is-logged-in to access Cart module
$routes->group('product', ['filter' => 'userlogin', 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->add('updateCart', 'Product::updateCart');
    $routes->add('clearCart', 'Product::clearCart');
    $routes->add('cart', 'Product::cart');
});

// Check user-is-logged-in to access Order module
$routes->group('order', ['filter' => 'userlogin', 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->add('/', 'Orders::index');
    $routes->add('view/(:any)', 'Orders::view/$1');
    $routes->add('checkout', 'Orders::checkout');
    $routes->add('checkoutOrder', 'Orders::checkOutOrder');
    $routes->add('checkoutOrderItem', 'Orders::checkOutOrderItem');
    $routes->add('makePayment/(:any)', 'Orders::makePayment/$1');

    $routes->add('api', 'Orders::api');
});

// Check user-is-logged-in to access Review module
$routes->group('review', ['filter' => 'userlogin', 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->add('create', 'Review::create');
});

// Check user-is-not-logged-in to access: -
$routes->group('user', ['filter' => 'guest', 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->add('login', 'Users::login');
    $routes->add('loginWithGoogle', 'Users::loginWithGoogle');
    $routes->add('validate', 'Users::validateLogin');
    $routes->add('register', 'Users::register');
    $routes->add('create', 'Users::create');
    $routes->add('forget', 'Users::forget');
    $routes->add('resetPassword', 'Users::resetPassword');
    $routes->add('recover/(:any)/(:any)', 'Users::recover/$1/$2');
    $routes->add('recoverPassword/(:any)/(:any)', 'Users::recoverPassword/$1/$2');
    $routes->add('accountActivate/(:any)/(:any)', 'Users::activate/$1/$2');
    $routes->add('registerSubmit', 'Users::emailForActivation');
});

// Check user-is-logged-in to access: -(LogOut)
$routes->group('user', ['filter' => 'userlogin', 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->add('logout', 'Users::logout');
});

// Admin module (\Back)
$routes->group('admin', ['namespace' => 'App\Controllers\Back'], function ($routes) {

    ##//Filter AlreadyLoggedIn -- NOT logged in user (seller,admin) can access
    $routes->group('', ['filter' => 'alreadyloggedin', 'namespace' => 'App\Controllers\Back'], function ($routes) {
        // seller
        $routes->add('seller/login', 'Seller::login');
        $routes->post('seller/login/auth', 'Login::auth');
    });

    ##//Filter AuthCheck -- logged in Seller,Admin can access:- Notes: remove the 'authcheck' filter if you want to skip the login
    $routes->group('', ['filter' => 'authcheck', 'namespace' => 'App\Controllers\Back'], function ($routes) {

        // Products & Category
        $routes->add('product', 'Products::index');
        $routes->add('product/add', 'Products::add');
        $routes->post('product/create', 'Products::create');
        $routes->add('product/edit/(:num)', 'Products::edit/$1');
        $routes->add('product/update/(:num)', 'Products::update/$1');
        $routes->add('category', 'Category::index');
        $routes->post('category/create', 'Category::create');
        $routes->add('product/fetch/(:any)', 'Products::fetchProduct/$1');
        $routes->post('product/delete/(:num)', 'Products::delete/$1');
        $routes->add('category/edit/(:any)', 'Category::edit/$1');
        $routes->add('category/update', 'Category::update');
        $routes->add('category/delete/(:any)', 'Category::delete/$1');
        $routes->get('productCategory/fetch', 'ProductCategory::fetch');
        // Product Pics
        $routes->post('pics/remove', 'ProductPic::remove');

        // Orders
        $routes->add('order', 'Order::index');
        $routes->add('order/add', 'Order::add');
        $routes->add('order/create', 'Order::create');
        $routes->add('order/edit/(:any)', 'Order::edit/$1');
        $routes->add('order/updateStatus/(:any)', 'Order::updateStatus/$1');

        // Payments
        $routes->add('payment', 'Payment::index');

        // Dashboard
        $routes->add('/', 'Dashboard::index');
        $routes->add('dashboard', 'Dashboard::index');

        // Slider
        $routes->add('slider', 'Slider::index');
        $routes->post('slider/create', 'Slider::create');
        $routes->add('slider/edit/(:num)', 'Slider::edit/$1');
        $routes->add('slider/update/(:num)', 'Slider::update/$1');
        $routes->add('slider/delete/(:num)', 'Slider::delete/$1');

        // Feature
        $routes->add('feature', 'Feature::index');
        $routes->post('feature/create', 'Feature::create');
        $routes->add('feature/edit/(:num)', 'Feature::edit/$1');
        $routes->add('feature/update/(:num)', 'Feature::update/$1');
        $routes->add('feature/delete/(:num)', 'Feature::delete/$1');

        // Seller
        $routes->add('seller/profile/(:num)', 'Seller::profile/$1');
        $routes->add('seller/logout', 'Login::logout');

        // User
        $routes->get('user/fetch/(:num)', 'User::fetchUser/$1');

        ##//Filter AdminOnly -- Admin can access:- Notes: remove the 'adminonly' filter if you want to access uri below.
        $routes->group('', ['filter' => 'adminonly', 'namespace' => 'App\Controllers\Back'], function ($routes) {
            // User
            $routes->add('user', 'User::index');
            $routes->add('user/create', 'User::create');
            $routes->add('user/edit/(:any)', 'User::edit/$1');
            $routes->add('user/update', 'User::update');
            $routes->add('user/delete/(:any)', 'User::delete/$1');
            $routes->add('user/address/(:num)', 'User::showAddress/$1');

            // Seller
            $routes->add('seller', 'Seller::index');
            $routes->post('seller/create', 'Seller::create');

            $routes->PUT('seller/update/(:num)', 'Seller::update/$1');
            $routes->post('seller/delete/(:num)', 'Seller::delete/$1');
            $routes->get('seller/fetch/(:num)', 'Seller::fetchSeller/$1');
        });
    });
});

// Driver Module
$routes->group('driver', ['namespace' => 'App\Controllers\Back'], function ($routes) {


    //driver login
    $routes->add('/', 'Driver::login');
    $routes->add('checkLogin', 'Login::driver_auth');
    $routes->add('logout', 'Login::driver_logout');
});


$routes->group('driver', ['filter' => 'driverLogin', 'namespace' => 'App\Controllers\Back'], function ($routes) {

    $routes->add('page', 'Driver::page');

    // Driver List
    $routes->get('driverList', 'Driver::index');
    $routes->post('driverList/create', 'Driver::create');
    $routes->add('driverList/edit/(:num)', 'Driver::profile/$1');
    $routes->add('driverList/update/(:num)', 'Driver::update/$1');
    $routes->add('driverList/delete/(:num)', 'Driver::delete/$1');


    //Admin driver
    $routes->add('driverOrder', 'DriverOrder::index');
    $routes->add('driverOrder/edit/(:any)', 'DriverOrder::edit/$1');
    $routes->add('driverOrder/update/(:any)', 'DriverOrder::update/$1');

    //Driver driver
    $routes->add('driverOrderList', 'DriverOrder::driverOrderList');
    $routes->add('driverOrderList/edit/(:any)', 'DriverOrder::driverOrderList_edit/$1');
    $routes->add('driverOrderList/update/(:any)', 'DriverOrder::driverOrderList_update/$1');
});



// Driver API endpoint
$routes->group('api', ['filter' => 'jwtauth', 'namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('create', 'DriverAPI::createDriver');
    $routes->put('update', 'DriverAPI::updateDriver');
    $routes->get('viewdrivers', 'DriverAPI::getAllDrivers');
    $routes->get('pendingOrders', 'DriverAPI::getOrdersWithStatusOf/Waiting for Quotation');
    $routes->get('processingOrders', 'DriverAPI::getInProcessOrdersWithoutStatusOf/Success');
    $routes->post('pickupOrder', 'DriverAPI::pickUpOrderWithQuotation');
    $routes->get('getSingleOrder/(:num)', 'DriverAPI::getSingleOrder/$1');
    $routes->post('completeShipment', 'DriverAPI::confirmCompletionOfShipment');
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('login', 'DriverAPI::login');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
