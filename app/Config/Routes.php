<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Welcome::index');
$routes->get('signup', 'SignupController::index');
$routes->post('signup', 'SignupController::store');
$routes->get('login', 'SigninController::index');
$routes->post('login', 'SigninController::authenticate');
$routes->get('logout', 'SigninController::logout');
$routes->group('/', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('courses', 'Courses::index');
    $routes->get('question/(:segment)/(:segment)', 'QuestionController::show/$1/$2');
    $routes->post('question/check', 'QuestionController::check');
    $routes->post('csrf-refresh-endpoint', 'QuestionController::refreshCsrfToken');
});