<?php
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('TaskController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);

// ========================================
// ALL ROUTES - NO AUTH REQUIRED!
// ========================================
$routes->get('/', 'TaskController::index');          // Homepage = Dashboard
$routes->get('dashboard', 'TaskController::dashboard');
$routes->get('tasks', 'TaskController::index');
$routes->get('tasks/create', 'TaskController::create');
$routes->post('tasks', 'TaskController::store');
$routes->get('tasks/edit/(:num)', 'TaskController::edit/$1');
$routes->post('tasks/update/(:num)', 'TaskController::update/$1');
$routes->get('tasks/delete/(:num)', 'TaskController::delete/$1');

$routes->get('account', 'TaskController::account');
$routes->post('account/update', 'TaskController::accountUpdate');

$routes->get('projects', 'TaskController::projects');
$routes->post('projects', 'TaskController::projectsStore');
