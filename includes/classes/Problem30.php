<?php
/**
 * Project Euler - Problem 30
 *
 * Digit fifth powers
 *
 * Surprisingly there are only three numbers that can be written as the sum of fourth powers of their digits:
 * 1634 = 1^4 + 6^4 + 3^4 + 4^4
 * 8208 = 8^4 + 2^4 + 0^4 + 8^4
 * 9474 = 9^4 + 4^4 + 7^4 + 4^4
 * As 1 = 1^4 is not a sum it is not included.
 * The sum of these numbers is 1634 + 8208 + 9474 = 19316.
 * Find the sum of all the numbers that can be written as the sum of fifth powers of their digits. 
 *
 * @category ProjectEuler
 * @package Problem30
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=30
 *
 */
class Problem30 extends Problem_Abstract
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
    const INPUT = 5; // Problem value
    // const INPUT = 4; // Test value - returns 19316

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
        return $this->findSumDigitPowers(self::INPUT);
    }

    /**
     * Summ all numbers where you test each number, take each digit and raise it to $power
     * and add those values together. If that number is equal to the number itself than add
     * that to the sum of other numbers with that quality
     *
     * @param string $power Power to raise each digit to
     *
     * @return int Sum of numbers that fit this criteria
     */
    private function findSumDigitPowers($power){
        $iMax = 10000000; // arbitrary upper boundary - curious if project euler is "cheating" and some massive number fits this criteria 
        $returnSum = 0;
        for ($i = 2; $i <= $iMax; $i++) { 
            $numbers = str_split($i);
            $testSum = 0;
            foreach ($numbers as $number) {
                $testSum += pow($number, $power);
            }
            if ($testSum == $i) {
                $returnSum += $i;
                // echo $i . " is a sum of " . implode("^$power + ", $numbers) . "^$power.\n"; // debug
            }
        }
        return $returnSum;
    }
}
