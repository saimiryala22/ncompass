<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Index pages routing
$routes->get('/', 'Index::index');

service('auth')->routes($routes);

// features roting page
$routes->get('features', 'Index::features');

// consulting roting page
$routes->get('consulting', 'Index::consulting');

// Saving presentation user information in consulting
$routes->post('prerequestinsert', 'Index::prerequestinsert', ['as' => 'presentation.download']);

// customisedcms roting page
$routes->get('customisedcms', 'Index::customisedcms');

// about us roting page
$routes->get('aboutus', 'Index::aboutus');

// Saving contect us information in index page
$routes->post('contactusform', 'Index::contactusform', ['as' => 'contactusform.download']);

// about us roting page
$routes->get('loginuser', 'Index::loginuser');

// Saving login user information in index page
$routes->post('logininsert', 'Index::logininsert', ['as' => 'logininsert.download']);

// about us roting page
$routes->get('customlogout', 'Index::customlogout');

// admin pages routing
$routes->get('profile', 'Admin::profile');


// employee pages routing
$routes->get('profile', 'Employee::profile');

// admin dashbaord pages routing
$routes->get('admin/maindashboard', 'Admin\Dashboard::maindashboard');

