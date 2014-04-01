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
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Description of input
     * @const string INPUT
     */
    // const INPUT = 1000; // Problem Value;
    const INPUT = 10; // Test Value - Should be 6;

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
        return $this->findDenominatorWithLongestRecurringCycle(self::INPUT);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findDenominatorWithLongestRecurringCycle($maxDenominator){
        $maxCycle = 0;
        $maxD = 0;
        for ($i = 2; $i <= $maxDenominator; $i++) {
            $testNumber = 1/$i;
            $currentCycle = $this->findCycle($testNumber);
            if ($currentCycle > $maxCycle) {
                $maxD = $i;
                $maxCycle = $currentCycle;
            }
            echo "denominator: $i, test number: $testNumber, current cycle: $currentCycle, max cycle: $maxCycle, max d: $maxD \n"; 
        }
        return $maxD;
    }

    private function findCycle($num) {
        $digits = substr((string)$num, 2, -1); // get rid of 0. and last digit which might be rounded up
        $maxMatch = 0;
        $testCycle = '';
        foreach ($digits as $digit) {
            $testCycle .= (string) $digit;

        }
    }
}
