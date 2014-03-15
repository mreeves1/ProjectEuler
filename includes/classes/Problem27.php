<?php
/**
 * Project Euler - Problem 27
 *
 * Quadratic primes
 *
 * Euler discovered the remarkable quadratic formula:
 * n² + n + 41
 * 
 * It turns out that the formula will produce 40 primes for the consecutive values n = 0 to 39. However, when n = 40, 402 + 40 + 41 = 40(40 + 1) + 41 is divisible by 41, and certainly when n = 41, 41² + 41 + 41 is clearly divisible by 41.
 * The incredible formula  n² - 79n + 1601 was discovered, which produces 80 primes for the consecutive values n = 0 to 79. The product of the coefficients, -79 and 1601, is 126479.
 * Considering quadratics of the form:
 * 
 * n² + an + b, where |a| < 1000 and |b| < 1000 where |n| is the modulus/absolute value of n e.g. |11| = 11 and |-4| = 4
 * 
 * Find the product of the coefficients, a and b, for the quadratic expression that produces the maximum number of primes for consecutive values of n, starting with n = 0. 
 *
 * @category ProjectEuler
 * @package Problem27
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=27
 *
 */
class Problem27 extends Problem_Abstract
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
    const INPUT = 1000;

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
        return $this->findMaxQuadraticPrimes(self::INPUT);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findMaxQuadraticPrimes($upperBound){
        $abProductMax = 0;
        $primeCountMax = 0;
        $lowerBound = (-1 * $upperBound) + 1;
        for ($a = $lowerBound; $a < $upperBound; $a++) {                                                                                  
            for ($b = $lowerBound; $b < $upperBound; $b++) {
                $primeCount = 0;
                $isPrime = true;
                $n = 0;
                while ($isPrime) {
                    $result = pow($n, 2) + ($a * $n) + $b;
                    if ($this->isPrime($result)) {
                        $primeCount++;
                    } else {
                        // echo "result of non prime is ".$result."\n"; // debug
                        $isPrime = false;
                    }
                    $n++; 
                }    
                $abProduct = $a * $b;
                if ($primeCount > $primeCountMax) {
                    $primeCountMax = $primeCount;
                    $abProductMax = $abProduct; 
                    // echo "new max found a=$a b=$b primeCount=$primeCount abProduct=$abProduct\n"; // debug
                }
            }                                                                                                                    
        }                                                                                                                        
        return $abProductMax;            
    }

    /**
     * Test if a number is prime.
     * 
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

}
