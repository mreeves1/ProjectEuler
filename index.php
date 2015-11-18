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
// With PHP 5.5+ (?) You can self run this with `php -S 127.0.0.1:10001 index.php`
// and then navigate to http://127.0.0.1:10001/index.php in your browser

// TODO: only list problems that have classes that exist?
// TODO: be able to view the class code too?
// TODO: Possibly have toggles to enable logging, view environment, show memory usage, show time elapsed, etc.
// TODO: DRY this out and don't litter logic in page

if(isset($argv[1])) { // command line support
   $_GET['problem'] = $argv[1];
}
$current_problem = isset($_GET['problem']) ? $_GET['problem'] : '';
?>
<html>
    <head>
        <title><?php echo $current_problem ? 'Problem #'.$current_problem.' Solution | ' : ''; ?>Mike's simple framework for Project Euler problems</title>
        <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
    </head>
    <body>
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
        <h1>Mike's simple framework for Project Euler problems</h1>
        <a href="http://projecteuler.net/problems">Project Euler</a> problems <strong>Rock!</strong>
        <p>Select the problem to run:<p/>
        <select name="problem">
        <?php
            $i_max = 100;
            for ($i = 1; $i <= $i_max; $i++) {
              $class_file = 'includes/classes/Problem'.$i.'.php';
              if (file_exists($class_file)) {
                $sel = $i == $current_problem ? ' selected="selected" ' : '';
                echo '<option value="'.$i.'" '.$sel.'>Problem #'.$i.'</option>'."\n";
              }
            }
        ?>
        </select>
        <input type="submit" name="Submit" value="Run Problem"/>
        </form>
        <p>
        <?php
          if ($current_problem) {
            $class_name = 'Problem'.$current_problem;
            $class_file = "includes/classes/$class_name.php";
            if (file_exists($class_file)) {
              $problem = new $class_name();
              echo '<li>The answer to <a href="http://projecteuler.net/problem='.$i.'" target="_blank">';
              echo str_replace('Problem', 'Problem ', get_class($problem)).'</a> is '.$problem->execute().'.';
              echo "</li>\n";
            } else {
              echo '<span style="color:red">Problem '.$current_problem.' not found!</span>';
            }
          }
        ?>
        </p>
    </body>
</html>
