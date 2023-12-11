<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*Login*/
$routes->get('/', 'Home::index');
$routes->post('login', 'Home::valid');

/*Signup*/
$routes->get('signup', 'Signup::index');
$routes->post('signup/register', 'Signup::register');

/*Categories*/
$routes->get('categories', 'Admin::index');

/*Delete categorie*/
$routes->get('categorie_delete/(:num)', 'Admin::deleteCategory/$1');

/*Edit categorie*/
$routes->get('categorie_edit/(:num)', 'Admin::edit/$1');
$routes->post('categorie/save_edit', 'Admin::save_edit');

/*Save categorie*/
$routes->get('categorie_add', 'Admin::add');
$routes->post('categorie/add', 'Admin::save');

/*-----------------------------------------------------------------*/

$routes->get('dashboard', 'User::index');

$routes->get('news_sources', 'User::news_sources');

/*Save news_source*/
$routes->get('news_source/add', 'User::add');
$routes->post('news_source/add', 'User::save');

/*Edit news_source*/
$routes->get('news_sources_edit/(:num)', 'User::edit/$1');
$routes->post('news_source/save_edit', 'User::save_edit');
/*Delete news_source*/
$routes->get('news_sources_delete/(:num)', 'User::deleteNewsSource/$1');

$routes->get('selectCategory/(:num)', 'User::selectCategory/$1');

$routes->match(['get', 'post'], 'dashboard', 'User::index');

/*Logout user*/
$routes->get('user/logout', 'User::logout');

/*Logout admin*/
$routes->get('user/logout', 'User::logout');

$routes->get('admin/logout', 'Admin::logout');


$routes->get('portada/(:num)/(:alpha)/(:alpha)', 'Portada::mostrarPortada/$1/$2/$3');