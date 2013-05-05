<?php
/**
 * Wrapper page to interact with various Project Euler Exercises
 *
 * @category ProjectEuler
 * @package default
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net
 *
 */

include_once('includes/init.php');

for ($i = 1; $i < 2; $i++) {
    $className = 'Problem'.$i;
    $problem = new $className();
    echo '<li>The answer to '.str_replace('Problem','Problem ',get_class($problem)).' is '.$problem->execute().'.<br/><br/>';
}

// TODO: Make simple form page to run the various Project Euler exercises that exist
// TODO: Possibly have toggles to enable logging, view environment, show memory usage, time elapsed, etc.
