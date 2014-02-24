<?php
/**
 * Project Euler - Problem 3
 *
 * The prime factors of 13195 are 5, 7, 13 and 29.
 * What is the largest prime factor of the number 600851475143 ?
 *
 * The only tricky part about this exercise is php sucks at manipulating large integers:
 * NUMBER_INPUT > PHP_INT_MAX when PHP_INT_SIZE === 4 (as opposed to 8 on 64 bit systems)
 * so normal modulus, division, etc. do not work but instead cause floating point overflows and errors
 *
 * @category ProjectEuler
 * @package Problem3
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=3
 *
 */
class Problem3 extends Problem_Abstract
{
    /**
     * Number we are finding prime factors for
     * @const string NUMBER_INPUT
     */
    const NUMBER_INPUT = '600851475143'; // Problem 3 value
    // const NUMBER_INPUT = '13195'; // Test case. Answer should be 29.

    /**
     * Check if critical extension to do math on large integers is available
     */
    public function __construct()
    {
        parent::__construct();
        if (!extension_loaded('bcmath')) {
            // TODO: throw nicer exception if bcmath is not available
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
        // echo 'NUMBER_INPUT: '.self::NUMBER_INPUT.'<br>';
        // echo 'PHP_INT_MAX: '.PHP_INT_MAX.'<br>';
        // echo 'PHP_INT_SIZE: '.PHP_INT_SIZE.'<br>';
        return $this->findLargestPrimeFactor(self::NUMBER_INPUT);
    }

    /**
     * Test if a number is prime. If it is add it to the list of primes.
     * If we are using this in other functions it is critical we test small numbers first.
     * Otherwise the array of primes will be incomplete.
     *
     * @param int $number Test if this number is prime
     *
     * @return bool
     */
    private function isPrime($number){
        if ($number < 2){
            return false;
        }
        elseif ($number === 2){
            return true;
        }
        // TODO: We should remember our old primes and start from the last one instead of 3.
        $upperBound = bcsqrt((string) $number);
        for ($j = 3; $j < $upperBound; $j = $j + 2) { // only need to test odd numbers > 2 for prime
            if ($number % $j === 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Find largest prime factor of a number.
     *
     * @param string $number number to find prime factors of
     *
     * @return int largest prime factor
     */
    private function findLargestPrimeFactor($number){
        $i = 2;
        $primeFactors = array();
        while (bccomp($number, '1') > 0) {
            $mod = (int) bcmod($number, (string) $i);
            if ($mod === 0 && $this->isPrime($i)) {
                $primeFactors[] = $i;
                $number = bcdiv($number, (string) $i);
                continue;
            }
            $i++;
        }

        return array_pop($primeFactors);
    }
}
