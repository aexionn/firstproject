<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
$routes->get('/', 'RegisterContr::index');
$routes->get('/register', 'RegisterContr::index');
$routes->match(['get', 'post'], '/registerProcess', 'RegisterContr::store');
$routes->match(['get', 'post'], '/loginProcess', 'LoginContr::auth');
$routes->get('/login', 'LoginContr::index');
$routes->get('/dashboard', 'NoteContr::dashboard');
$routes->get('/saveNote', 'NoteContr::save');
$routes->post('/saveProcess', 'NoteContr::saveProcess');
$routes->get('/logout', 'LoginContr::logout');
$routes->get('/edit/(:segment)', 'NoteContr::edit/$1');
$routes->put('/editProcess/(:any)', 'NoteContr::editProcess/$1');
$routes->delete('/delete/(:num)', 'NoteContr::delete/$1');
$routes->get('/userProfile', 'ProfileContr::profile');
$routes->put('/editProfile/(:any)', 'ProfileContr::editUserData/$1');
$routes->put('/editPassword/(:any)', 'ProfileContr::editUserPassword/$1');
$routes->delete('/deleteUser/(:num)', 'ProfileContr::deleteUser/$1');
$routes->put('/editAvatar/(:any)', 'ProfileContr::editUserAvatar/$1');
$routes->delete('/deleteAvatar/(:any)', 'ProfileContr::removeAvatar/$1');
$routes->get('/cari', 'NoteContr::search');
$routes->get('/addCate', 'NoteContr::addCategory');
$routes->post('/cateProcess', 'NoteContr::addCatProcess');
$routes->get('/restoreNote', 'NoteContr::restore');
$routes->get('/restoreNote/(:num)', 'NoteContr::restore/$1');
$routes->delete('/deletePermanent', 'NoteContr::delPermanent');
$routes->delete('/deletePermanent/(:num)', 'NoteContr::delPermanent/$1');
$routes->get('/listCate', 'NoteContr::listCategory');
$routes->get('/editCate/(:any)', 'NoteContr::editCategory/$1');
$routes->put('/editCateProcess/(:any)', 'NoteContr::editCProcess/$1');
$routes->delete('/deletecate/(:num)', 'NoteContr::deletecate/$1');
$routes->delete('/delcateonnote/(:any)/(:any)', 'NoteContr::delCateOnNote/$1/$2');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
