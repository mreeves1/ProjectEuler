<?php
/**
 * Project Euler - Problem 39
 *
 * Integer right triangles
 *
 * If p is the perimeter of a right angle triangle with integral length sides, {a,b,c}, there are exactly three solutions for p = 120.
 *
 * {20,48,52}, {24,45,51}, {30,40,50}
 *
 * For which value of p <= 1000, is the number of solutions maximised? 
 *
 * @category ProjectEuler
 * @package Problem39
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=39
 *
 */
class Problem39 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Description of input
     * @const string INPUT
     */
    const PERIMETER_MAX = 1000; // Problem Value 
    // const PERIMETER_MAX = 120; // Test Value, answer will be 120 (of course) with 3 solutions

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
        return $this->findMaxPerimeterSolutions(self::PERIMETER_MAX);
    }

    /**
     * Find Perimeter below $p_max that has the most right angle integral solutions
     * e.g. it fulfills a^2 + b^2 = c^2
     *
     * @param string $p_max Maximum perimeter to test
     *
     * @return int The perimeter that has the most solutions
     */
    private function findMaxPerimeterSolutions($p_max)
    {
        $s_max = 0;
        $p_answer = 0;
        $p_init = 3 + 4 + 5; // smallest integral right triangle is a=3, b=4, c=5
        for ($p = 12; $p <= $p_max; $p++) {
            $s_current = $this->countPerimeterSolutions($p);
            // echo "$p has $s_current solutions\n"; // debug
            if ($s_current > $s_max) {
                $p_answer = $p;
                $s_max = $s_current;
            };
        }
        return $p_answer;
    }

    /**
     * Find how many right angle integral solutions this perimeter has 
     *
     * @param string $p Perimeter to test
     *
     * @return int Number of solutions this perimeter has
     */
    private function countPerimeterSolutions($p)
    {
        $solutions = array();
        $max = ceil($p/2); // arbitrary maximum, probably can be improved
        for ($a = 1; $a < $max; $a++) {
            for ($b = 1; $b < $max; $b++) { // must be some way to optimize this. Possibly step down from max til it hits a?
                $c = sqrt(pow($a, 2) + pow($b, 2)); // will we have floating point issues?
                // echo "a: $a, b: $b, c: $c\n";
                if ($p == ($a + $b + $c)) {
                    $solution = array($a, $b, $c);
                    sort($solution);
                    $key = implode(",",$solution);
                    if (!isset($solutions[$key])) {
                        $solutions[$key] = $solution;
                        // echo "$key\n";
                    }
                }
            }
        }
        // echo "Solutions for P of $p\n"; // debug
        // echo var_export($solutions)."\n"; // debug
        return count($solutions);
    }
}
