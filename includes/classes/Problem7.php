<?php
/**
 * Project Euler - Problem 7
 *
 * 10001st prime
 *
 * By listing the first six prime numbers: 2, 3, 5, 7, 11, and 13, we can see that the 6th prime is 13.
 * What is the 10,001st prime number?
 *
 * @category ProjectEuler
 * @package Problem7
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=7
 *
 */
class Problem7 extends Problem_Abstract
{
    /**
     * Prime to find
     * @const int INPUT
     */
    const INPUT = 10001;

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findNthPrime(self::INPUT);
    }

    /**
     * Test if a number is prime.
     * .
     * @param int $number test if this number is prime
     *
     * @return bool
     */
    private function isPrime($number){
        if ($number < 2){
            return false;
        } elseif ($number === 2){
            return true;
        } elseif ($number % 2 === 0) {
            return false;
        }
        $upperBound = ceil(sqrt($number));

        for ($j = 3; $j <= $upperBound; $j = $j + 2) {
            if ($number % $j === 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Find nth prime.
     *
     * @param int $n which prime to return (ie, 1st is 2, 2nd is 3, etc.)
     *
     * @return int value of nth prime
     */
    private function findNthPrime($n){
        $_primes = array(2);
        $_testNumber = 3;
        while (!isset($_primes[$n - 1])) {
            if ($this->isPrime($_testNumber)) {
                $_primes[] = $_testNumber;
            }
            $_testNumber = $_testNumber + 2;
        }
        // echo '<pre>'.var_export($_primes).'</pre><br/>'; // debug
        return $_primes[$n - 1];
    }
}
