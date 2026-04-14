<?php
/**
 * Application Bootstrap
 * The main entry point for the application
 */

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define root path
define('ROOT_PATH', dirname(dirname(__FILE__)));

// Load configuration
require_once ROOT_PATH . '/config/config.php';

// Load core classes
require_once APP_PATH . '/Database.php';
require_once APP_PATH . '/Model.php';
require_once APP_PATH . '/Controller.php';
require_once APP_PATH . '/Router.php';
require_once APP_PATH . '/Middleware/AuthMiddleware.php';

// Load routes
$routes = require_once ROUTES_PATH . '/routes.php';

// Create router and register routes
$router = new Router();
$routes($router);

// Dispatch route
$router->dispatch();
