<?php
/**
 * Project Euler - Problem 56
 *
 * Powerful digit sum
 *
 * A googol (10^100) is a massive number: one followed by one-hundred zeros; 100^100 is almost unimaginably large: one followed by two-hundred zeros. Despite their size, the sum of the digits in each number is only 1.
 * Considering natural numbers of the form, a^b, where a, b < 100, what is the maximum digital sum? 
 *
 * @category ProjectEuler
 * @package Problem56
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=56
 *
 */
class Problem56 extends Problem_Abstract
{
    /**
     * Largest value for a and b
     * @const string UPPER_BOUND
     */
    const UPPER_BOUND = 100;

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
        return $this->findMaxDigitalSum(self::UPPER_BOUND);
    }

    /**
     * Find the maximum sum of the digits of a^b where a and b < 100 
     *
     * @param int $upper_bound Maximum value of a and b
     *
     * @return int Maximum digital sum
     */
    private function findMaxDigitalSum($upper_bound){
        $max_digit_sum = 0;
        for ($a = 1; $a < $upper_bound; $a++) {
            for ($b = 1; $b < $upper_bound; $b++) {
                $val = bcpow($a, $b);
                $digits = str_split($val);
                $sum = array_sum($digits);
                $max_digit_sum = $sum > $max_digit_sum ? $sum : $max_digit_sum;
            }
        }
        return $max_digit_sum;
    }
}
