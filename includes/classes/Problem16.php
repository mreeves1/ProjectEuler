<?php
/**
 * Project Euler - Problem 16
 *
 * Power digit sum
 *
 * 2^15 = 32768 and the sum of its digits is 3 + 2 + 7 + 6 + 8 = 26.
 * What is the sum of the digits of the number 2^1000?
 *
 * @category ProjectEuler
 * @package Problem16
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=16
 *
 */
class Problem16 extends Problem_Abstract
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
    const INPUT = '1000';

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        set_time_limit(self::PROBLEM_TIMEOUT_OVERRIDE);
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
        return $this->twoExponentSum(self::INPUT);
    }

    /**
     * Take 2 to the $exp power. Sum the digits of this number.
     *
     * @param string $exp what exponent to raise 2 to.
     *
     * @return int Take 2^$exp and sum the digits of the resulting number
     */
    private function twoExponentSum($exp){
        $sum = 0;
        $power = bcpow('2', $exp, 0);
        $arr = str_split($power);
        foreach($arr as $num) {
            $sum += $num;
        } 
        return $sum;
    }
}
