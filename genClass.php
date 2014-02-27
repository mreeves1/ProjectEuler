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
define('CLASS_TEMPLATE_FILE', 'ProblemTemplate.php');
define('TOKEN_PROB_NUMBER', '%%PROB_NUMBER%%');
define('TOKEN_PROB_DESC_SHORT', '%%PROB_DESC_SHORT%%');
define('TOKEN_PROB_DESC_LONG', '%%PROB_DESC_LONG%%');

if (isset($argv) && isset($argv[1]) && is_numeric($argv[1])) {
    $projectNumber = $argv[1];
    $newFile = CLASS_DIR.'Problem'.$projectNumber.'.php';
    $templateFile = CLASS_DIR.CLASS_TEMPLATE_FILE;
    if (file_exists($newFile)) {
        echo "Class file ".$newFile." already exists. Exiting. \n";
    } else {
        $input = file_get_contents($templateFile);
        $peHtml = file_get_contents(PE_BASE_URL.$projectNumber); // TODO: add checks for failures
        $dom = new DOMDocument();
        $dom->loadHTML($peHtml);
        $h2Elements = $dom->getElementsByTagName('h2');
        $projectDescShort = $h2Elements->item(0)->nodeValue;

        // <div class="problem_content" role="problem">
        $divElements = $dom->getElementsByTagName('div');
        foreach ($divElements as $divElem) {
            if ($divElem->getAttribute('class') == "problem_content" && $divElem->getAttribute('role') == "problem") {
                $projectDescLong = trim($divElem->nodeValue);
                $projectDescLong = str_replace("\n", "\n * ", $projectDescLong);
	    }

        }

        $output = str_replace(TOKEN_PROB_NUMBER, $projectNumber, $input);
        $output = str_replace(TOKEN_PROB_DESC_SHORT, $projectDescShort, $output);
        $output = str_replace(TOKEN_PROB_DESC_LONG, $projectDescLong, $output);
        $writeResult = file_put_contents($newFile, $output);
        if ($writeResult === false) {
            // echo $output; 
            echo "Write of Problem # ".$projectNumber ." to " . $newFile . " failed!\n";
        } else {
            echo "Write of Problem # ".$projectNumber ." to " . $newFile . " succeeded!\n";

        }
    }

} else {
    echo "Please enter which Project Euler project number you wish to generate a class for?\n";
}




