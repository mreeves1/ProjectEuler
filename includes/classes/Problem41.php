<?php
/**
 * Project Euler - Problem 41
 *
 * Pandigital prime
 *
 * We shall say that an n-digit number is pandigital if it makes use of all the digits 1 to n exactly once. For example, 2143 is a 4-digit pandigital and is also prime.
 * What is the largest n-digit pandigital prime that exists? 
 *
 * @category ProjectEuler
 * @package Problem41
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=41
 *
 */
class Problem41 extends Problem_Abstract
{
    /**
     * Largest number to check
     *
     * This is a bit dodgy and a "gotcha". Made me try again and again to optimize my algos! :-/
     * Due to the "Divisibility rule" we can deduce that neither 987654321 nor 87654321 
     * should be our upper bound. This is because 9+8+7+6+5+4+3+2+1 = 45 which is divisible by 3
     * and 8+7+6+5+4+3+2+1 = 36 which is also divisible by 3.
     *
     * @link http://en.wikipedia.org/wiki/Divisibility_rule
     *
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 7654321; // Problem value
    # const UPPER_BOUND = 2201; // Testing value, answer is 2143

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

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
        return $this->findLargestPandigitalPrime(self::UPPER_BOUND);
    }

    /**
     * Find Largest Pandigital Prime.
     *
     * @param string $upper_bound Largest number to check
     *
     * @return int Largest pandigital prime
     */
    private function findLargestPandigitalPrime($upper_bound){
        $this->initPrimes(200);

        $test_counter = 0;
        for ($i = $upper_bound; $i > 1; $i -= 2){
            if ($this->isPandigital($i) && $this->isPrime($i)) {
                return $i;
            }
        }
    }

    /** 
     * Used to generate a sieve of erastosthenes to speed up subsequent isPrime calls
     *
     * @link http://en.wikipedia.org/wiki/Sieve_of_Eratosthenes
     */ 
    private function initPrimes($n) {
        for ($i = 3; $i <= $n; $i = $i + 2) {
            // effectively caches some prime values to speed up our future calcs 
            $this->isPrime($i);
        } 
    }

    /**
     * Test for Prime-ness
     *
     * @param string $n Number to test for primality
     *
     * @return boolean Is number prime?
     */
    private function isPrime($n) {
        static $primes = array(2, 3);
        if ($n === 1) {
            return false;
        } elseif ($n <= 3) {
            return true;
        } elseif ($n % 2 == 0 || $n % 3 == 0) {
            return false;
        } else {
            foreach ($primes as $prime) { // Use sieve
                if ($n > $prime && $n % $prime == 0) {
                    return false;
                }
            }
            // TODO: Come back and understand this prime test algo better
            for ($i = 5; $i <= sqrt($n) + 1; $i += 6) { 
                if ($n % $i == 0 || $n % ($i + 2) == 0) {
                    return false;
                }
            }
            // Store in sieve
            if ($n < 300 && !in_array($n, $primes)) {
                $primes[] = $n;
            }
            return true;
        }
    }

    /**
     * Test for pandigital-ness
     * e.g. when a numbers digits are ordered they go from 1 to n where n is the number of digits in the number
     *
     * @param string $n Number to check
     *
     * @return boolean Is number pandigital?
     */
    private function isPandigital($n) {
        $digits = str_split($n);
        sort($digits);
        $digits_str = implode("", $digits);
        $test_full = "123456789";
        $test_str = substr($test_full, 0, strlen($digits_str));
        return (strcmp($test_str, $digits_str) === 0);
    }
}
