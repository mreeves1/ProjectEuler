<?php
/**
 * Project Euler - Problem 20
 *
 * Factorial digit sum
 *
 * n! means n  (n  1)  ...  3  2  1
 * For example, 10! = 10  9  ...  3  2  1 = 3628800,and the sum of the digits in the number 10! is 3 + 6 + 2 + 8 + 8 + 0 + 0 = 27.
 * Find the sum of the digits in the number 100! 
 *
 * @category ProjectEuler
 * @package Problem20
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=20
 *
 */
class Problem20 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Description of input
     * @const int INPUT
     */
    // const INPUT = 10; // Test Input
    const INPUT = 100; // Problem Input

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
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
        return $this->findFactorialDigitSum(self::INPUT);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findFactorialDigitSum($number){

        $factorialResult = $this->fact($number);
        $digits = str_split($factorialResult);
        return array_sum($digits);
    }

    private function fact($number) {
        $result = 1;
        while ($number > 1) {
            $result = bcmul($result, $number);
            $number--;
        }
        return $result;
    }

}
