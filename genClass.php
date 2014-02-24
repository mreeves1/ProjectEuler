<?php
/**
 * File to generate class files for Project Euler Exercises
 *
 * @category ProjectEuler
 * @package default
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net
 *
 */

define('PE_BASE_URL', 'http://projecteuler.net/problem=');
define('CLASS_DIR', 'includes/classes/');
define('CLASS_TEMPLATE', 'ProblemTemplate.php');

if (isset($argv) && isset($argv[1]) && is_numeric($argv[1])) {
    $argument1 = $argv[1];

    $newFile = CLASS_DIR.'Problem'.$argv[1].'.php';
    if (file_exists($newFile)) {
        echo "Class file ".$newFile." already exists. Exiting. \n";
    } else {

    }

} else {
    echo "Please enter which Project Euler project number you wish to generate a class for?\n";
}




