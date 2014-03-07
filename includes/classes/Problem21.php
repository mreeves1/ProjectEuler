<?php
/**
 * Project Euler - Problem 21
 *
 * Amicable numbers
 *
 * Let d(n) be defined as the sum of proper divisors of n (numbers less than n which divide evenly into n).
 * If d(a) = b and d(b) = a, where a b, then a and b are an amicable pair and each of a and b are called amicable numbers.
 * For example, the proper divisors of 220 are 1, 2, 4, 5, 10, 11, 20, 22, 44, 55 and 110; therefore d(220) = 284. The proper divisors of 284 are 1, 2, 4, 71 and 142; so d(284) = 220.
 * Evaluate the sum of all the amicable numbers under 10000. 
 *
 * @category ProjectEuler
 * @package Problem21
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=21
 *
 */
class Problem21 extends Problem_Abstract
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
    // const INPUT = 300; // Test Input
    const INPUT = 10000; // Problem Input

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
        return $this->findAmicableNumbersSum(self::INPUT);
    }

    /**
     * Find all the amicable pairs under the $upperLimit and return their sum
     */
    private function findAmicableNumbersSum($upperLimit){
        $amicableSum = 0;
        $divSumMap = array();
        for ($i = 1; $i < $upperLimit; $i++) {
            $divisorSum = $this->findDivisorsSum($i);
            $divSumMap[$i] = $divisorSum;
            if (isset($divSumMap[$divisorSum]) && $divSumMap[$divisorSum] == $i && $divisorSum != $i) {
                // echo "$i and $divisorSum are amicable pairs\n"; // debug
                $amicableSum += ($i + $divisorSum);
            } 
        }   
        return $amicableSum;
    }

    /**
     * Find the divisors of a $number and return their sum
     */
    private function findDivisorsSum($number) {
        $divisors = array();
        for ($i = 1; $i < ceil($number/2) + 1; $i++) {
            if ($number % $i == 0) {
                $divisors[] = $i;
            }
        }
        return(array_sum($divisors));
    }

}
