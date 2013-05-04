<?php
/**
 * Procedural Initialization and Configuration
 *
 * @category ProjectEuler
 * @package default
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net
 *
 */

// TODO: per PSR-1 possibly separate declarative from mutable code

// Constants
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BP', dirname(__DIR__)); // base path shortcut
define('ID', __DIR__);          // include directory shortcut

// Include Paths
$includePathsArray = array(
                     ID.DS.'classes',
                     ID.DS.'lib'.DS.'vendor',
                 );
$includePathNew = implode(PS, $includePathsArray).PS.ini_get('include_path');
ini_set("include_path", $includePathNew);

// Error Settings
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
umask(0);

// Autoload Settings
/*
 * Based on PSR-0 lightweight autoloader spec
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md#splclassloader-implementation
 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DS, $namespace) . DS;
    }
    $fileName .= str_replace('_', DS, $className) . '.php';

    require $fileName;
}
spl_autoload_register('autoload');