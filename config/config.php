<?php
/**
 * Application Configuration
 */

// Database Configuration
define('DB_HOST', 'sql100.infinityfree.com');
define('DB_USER', 'if0_41596960');
define('DB_PASS', 'DominusV2007');
define('DB_NAME', 'if0_41596960_parkiu');
define('DB_CHARSET', 'utf8mb4');

// Application Settings
define('APP_NAME', 'Parkify - Sistem Parkir');
define('APP_URL', 'https://parkiu.wuaze.com');
// define('BASE_URL', rtrim(APP_URL, '/') . '/');
define('APP_DEBUG', false);

// Session Configuration
define('SESSION_TIMEOUT', 3600); // 1 hour

// Pagination
// define('ITEMS_PER_PAGE', 10);

// Paths
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', BASE_PATH . '/app');
define('VIEWS_PATH', APP_PATH . '/Views');
define('MODELS_PATH', APP_PATH . '/Models');
define('CONTROLLERS_PATH', APP_PATH . '/Controllers');
define('ROUTES_PATH', BASE_PATH . '/routes');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('ASSETS_PATH', PUBLIC_PATH . '/assets');

// Timezone
date_default_timezone_set('Asia/Jakarta');
