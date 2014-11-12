<?php
/**
 * Project Euler - Problem 26
 *
 * Reciprocal cycles
 *
 * A unit fraction contains 1 in the numerator. The decimal representation of the unit fractions with denominators 2 to 10 are given:
 * 
 * 1/2= 0.5
 * 1/3= 0.(3)
 * 1/4= 0.25
 * 1/5= 0.2
 * 1/6= 0.1(6)
 * 1/7= 0.(142857)
 * 1/8= 0.125
 * 1/9= 0.(1)
 * 1/10= 0.1
 * 
 * Where 0.1(6) means 0.166666..., and has a 1-digit recurring cycle. It can be seen that 1/7 has a 6-digit recurring cycle.
 * Find the value of d  1000 for which 1/d contains the longest recurring cycle in its decimal fraction part. 
 *
 * @category ProjectEuler
 * @package Problem26
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=26
 *
 */
class Problem26 extends Problem_Abstract
{
    /**
     * Description of input
     * @const string INPUT
     */
    const INPUT = 1000; // Problem Value;
    // const INPUT = 10; // Test Value - Answer should be 7;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
        if (!extension_loaded('bcmath')) {
            // Placeholder for any extensions required for this problem's code
            die('BCMath extension required. See http://www.php.net/manual/en/book.bc.php .');
        }
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findDenominatorWithLongestRecurringCycle(self::INPUT);
    }

    /**
     * Find the denominator D with the longest recurring cycle
     *
     * @param string $max_denominator Largest d to test
     *
     * @return int denominator D
     */
    private function findDenominatorWithLongestRecurringCycle($max_denominator)
    {
        $max_denom = 0;
        $max_digits = 2000; // Trial and error to figure out how many digits we need to test
        $d_cycle_map = array(); 
        for ($i = 2; $i <= $max_denominator; $i++) {
            $x = bcdiv(1, (string)$i, $max_digits);
            // echo $x."\n"; // debug
            $cycle_length = $this->findCycle($x);
            $d_cycle_map[$i] = $cycle_length;
        }
        arsort($d_cycle_map);
        // echo var_export($d_cycle_map, true)."\n"; // debug
        $answer_count = reset($d_cycle_map);
        $answer_d = key($d_cycle_map);
        // echo "D is $answer_d with a count of $answer_count.\n"; // debug
        return ($answer_d);

    }

    private function findCycle($num) 
    {
        $haystack = substr((string)$num, 2, -1); // get rid of 0. and last digit which might be rounded up
        $pseudo_d = round(1/$num,0);
        $match_limit = 1000;
        $max_match = 0;
        $max_needle = "";
        for($start = 0; $start < 1; $start ++) { // premature optimization? Should we deal with extra leading digits that don't repeat?
            for ($end = 1; $end < $match_limit; $end++) {
                $needle = substr($haystack, $start, $end);
                $len = $end - $start;
                $next = substr($haystack, $start + $end, $end);
                if (($needle == $next) && ($len > $max_match) && (strlen($needle) > 1)) { // The strlen check is a bit of a hack to prevent a "greedy match" with repeating digits 
                    $max_match = $len;
                    $max_needle = $needle;
                    break;
                }  
            }
        }
        return $max_match;
    }
}
