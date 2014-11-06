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

// TODO: Make simple form page to run the various Project Euler exercises that exist.
// TODO: Possibly have toggles to enable logging, view environment, show memory usage, show time elapsed, etc.
?>
<html>
    <head>
        <title>Mike's simple framework for Project Euler problems</title>
        <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
    </head>
    <body>
        <h1>Mike's simple framework for Project Euler problems</h1>
        <a href="http://projecteuler.net/problems">Project Euler</a> problems <strong>Rock!</strong>
        <ul>
        <?php
            for ($i = 35; $i <= 35; $i++) {
                $className = 'Problem'.$i;
                $problem = new $className();
                echo '<li>The answer to <a href="http://projecteuler.net/problem='.$i.'" target="_blank">';
                echo str_replace('Problem', 'Problem ', get_class($problem)).'</a> is '.$problem->execute().'.';
                echo "</li>\n";
            }
        ?>
        </ul>
    </body>
</html>
