<?php
/**
 * Project Euler - Problem 37
 *
 * Truncatable primes
 *
 * The number 3797 has an interesting property. Being prime itself, it is possible to continuously remove digits from left to right, and remain prime at each stage: 3797, 797, 97, and 7. Similarly we can work from right to left: 3797, 379, 37, and 3.
 * Find the sum of the only eleven primes that are both truncatable from left to right and right to left.
 * NOTE: 2, 3, 5, and 7 are not considered to be truncatable primes. 
 *
 * @category ProjectEuler
 * @package Problem37
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=37
 *
 */
class Problem37 extends Problem_Abstract
{
    /**
     * Description of input
     * @const string INPUT
     */
    const UPPER_BOUND = PHP_INT_MAX;

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
        return $this->findTruncatablePrimeSum(self::UPPER_BOUND);
    }

    /**
     * Find Truncatable Prime Sum below $upper_bound
     * (Keeping in mind there are only 11 primes that are truncatable
     * both from the left and the right
     * 
     * @param string $upper_bound 
     *
     * @return int Sum of truncatable primes
     */
    private function findTruncatablePrimeSum($upper_bound){
        $prime_sum = 0;
        $prime_count = 0;
        $prime_count_max = 11;
        for ($i = 11; $i < $upper_bound; $i++) {
            if ($this->isPrime($i)) {
                $orig = (string) $i;
                $len = strlen($orig);
                $j = 1;
                $left_all_prime = true;
                while ($j < $len) {
                    $left = substr($orig, $j);
                    if (!$this->isPrime((int) $left)) {
                        $left_all_prime = false;
                        break;
                    }
                    $j++;
                }
                if ($left_all_prime) {
                    $k = $len - 1;
                    $right_all_prime = true;
                    while ($k > 0) {
                        $right = substr($orig, 0, $k);
                        if (!$this->isPrime((int) $right)) {
                            $right_all_prime = false;
                            break;
                        }
                        $k--;
                    }
                }
                if ($left_all_prime && $right_all_prime) {
                    $prime_sum += $orig;
                    $prime_count++;
                    $primes[] = $orig;
                    // echo "We found a prime: $orig\n"; // debug
                }
                if ($prime_count >= $prime_count_max) {
                    // echo "All bidirectional truncatable primes found:\n"; // debug
                    // echo var_export($primes, true)."\n"; // debug
                    break; // break out of outer for loop
                }
            }
        }
        return $prime_sum;
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
        if ($n == 1) {
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
}
