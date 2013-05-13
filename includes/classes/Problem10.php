<?php
/**
 * Project Euler - Problem 10
 *
 * Summation of primes
 *
 * The sum of the primes below 10 is 2 + 3 + 5 + 7 = 17.
 * Find the sum of all the primes below two million.
 *
 * @category ProjectEuler
 * @package Problem10
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=10
 */
class Problem10 extends Problem_Abstract
{
    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow, make this larger.
     * @const int PROBLEM_TIMEOUT_OVERRIDE Used with set_timeout_limit to extend timeout if computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 120;

    /**
     * Max number to sum primes up to
     * @const int INPUT
     */
    const INPUT = 2000000;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        set_time_limit(self::PROBLEM_TIMEOUT_OVERRIDE);
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     * @return int
     */
    public function execute()
    {
        return $this->sumPrimesBelow(self::INPUT);
    }

    /**
     * Test if a number is prime
     * @param int $number test if this number is prime
     * @return bool
     */
    private function isPrime($number){
        if ($number === 1) {
            return false;
        } elseif ($number < 4) {
            return true;
        } elseif ($number % 2 === 0) {
            return false;
        } elseif ($number % 3 === 0) {
            return false;
        }
        $upperBound = sqrt($number);

        for ($j = 3; $j <= $upperBound; $j = $j + 2) {
            if ($number % $j === 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Test if a number is prime
     * More efficient algorithm that divides a number by all the primes that have been found to see if it's prime
     * @param $number
     * @return bool
     */
    private function isPrime2($number){
        static $primes = array(2);
        if ($number === 1) {
            return false;
        } elseif ($number < 4) {
            $primes[] = $number;
            return true;
        } elseif ($number % 2 === 0) {
            return false;
        } elseif ($number % 3 === 0) {
            return false;
        }
        $upperBound = sqrt($number);
        $i = 0;
        while ($primes[$i] <= $upperBound) {
            if ($number % $primes[$i] === 0) {
                return false;
            }
            $i++;
        }
        $primes[] = $number;
        return true;
    }

    /**
     * Find summation of primes below maximum number
     * @param int $numberMax maximum number to sum up to but not including
     * @return int sum of primes below max number
     */
    private function sumPrimesBelow($numberMax){
        $t1 = microtime(true);
        $sum = 2; // first prime
        $testNumber = 3;
        while ($testNumber < $numberMax) {
            if ($this->isPrime2($testNumber)) {
                $sum += $testNumber;
            }
            $testNumber = $testNumber + 2;
        }
        $t2 = microtime(true);
        // echo 'This function took '.round(($t2-$t1),2).' seconds. '."<br/>\n"; // debug
        return $sum;
    }
}
