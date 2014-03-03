<?php
/**
 * Project Euler - Problem 22
 *
 * Names scores
 *
 * Using names.txt (right click and 'Save Link/Target As...'), a 46K text file containing over five-thousand first names, begin by sorting it into alphabetical order. Then working out the alphabetical value for each name, multiply this value by its alphabetical position in the list to obtain a name score.
 * For example, when the list is sorted into alphabetical order, COLIN, which is worth 3 + 15 + 12 + 9 + 14 = 53, is the 938th name in the list. So, COLIN would obtain a score of 938*53 = 49714.
 * What is the total of all the name scores in the file? 
 *
 * @category ProjectEuler
 * @package Problem22
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=22
 *
 */
class Problem22 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * File with 5000+ first names (comma delimited and quoted)
     * @const string INPUT
     */
    const INPUT = 'files/problem22_names.txt';

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
        set_time_limit(self::PROBLEM_TIMEOUT_OVERRIDE);
        if (!extension_loaded('bcmath')) {
            // Placeholder for any extensions required for this problem's code
            // die('BCMath extension required. See http://www.php.net/manual/en/book.bc.php .');
        }
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->nameScoreFile(self::INPUT);
    }

    /**
     * Open a file with comma separated and quoted capitalized names. 
     * Sort those names alphabetically. Score those names where A = 1, B = 2, etc. 
     * Multiply those scores by the name's position in the list.
     *
     * @param string $fileName
     *
     * @return int Total score
     */
    private function nameScoreFile($fileName){
        $nameString = file_get_contents($fileName);
        $nameString = str_replace('"', "", $nameString);
        $names = explode(",", $nameString);
        sort($names);
        // echo var_export($names, true); // debug
        $nameIndex = 1;
        $total = 0;
        foreach ($names as $name) {
            $total += $this->scoreName($name) * $nameIndex;
            $nameIndex++;
        }
        return $total;
    }

    /**
     * Score a name where you add each letter together.
     * A = 1, B = 2, etc. 
     *
     * @param string $name
     *
     * @return int Name score
     */
    private function scoreName($name){
        $letters = str_split($name);
        $score = 0;
        foreach ($letters as $letter) {
            $score += (ord($letter) - 64); // ord("A") returns "65" and we want "1"
        }
        return $score;
    }
}
