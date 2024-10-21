<?php

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */


$d_now = new Datetime();
$d_sidang = new Datetime('22-11-2024');

if ($d_now > $d_sidang) {
    define('ENVIRONMENT', 'production');
    $maintenance = true; ## set to true to enable
} else {
    $maintenance = false; ## set to true to enable
}

// $maintenance = false;

if ($maintenance) {
    if (isset($_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR'] == 'your_ip') {
        ##do nothing
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 1); ## to debug your maintenance view

        // require_once 'perbaikan.php'; ## call view
        echo 'upps error';
        // require_once '../app/Views/perbaikan.php'; ## call view
        return;
        exit();
    }
}


$minPhpVersion = '8.1'; // If you update this, don't forget to update `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}


/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// LOAD OUR PATHS CONFIG FILE
// This is the line that might need to be changed, depending on your folder structure.
require FCPATH . '../app/Config/Paths.php';
// ^^^ Change this line if you move your application folder

$paths = new Config\Paths();

// LOAD THE FRAMEWORK BOOTSTRAP FILE
require $paths->systemDirectory . '/Boot.php';

exit(CodeIgniter\Boot::bootWeb($paths));
