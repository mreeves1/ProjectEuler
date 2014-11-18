<?php
/**
 * Project Euler - Problem 50
 *
 * Consecutive prime sum
 *
 * The prime 41, can be written as the sum of six consecutive primes:
 * 41 = 2 + 3 + 5 + 7 + 11 + 13
 * This is the longest sum of consecutive primes that adds to a prime below one-hundred.
 * The longest sum of consecutive primes below one-thousand that adds to a prime, contains 21 terms, and is equal to 953.
 * Which prime, below one-million, can be written as the sum of the most consecutive primes? 
 *
 * @category ProjectEuler
 * @package Problem50
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=50
 *
 */
class Problem50 extends Problem_Abstract
{

    /**
     * Description of input
     * @const string INPUT
     */
    const UPPER_BOUND = 1000000;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findConsecutivePrimeSum(self::UPPER_BOUND);
    }

    /**
     * Find longest prime sum of consecutive primes under $upper_bound
     *
     * @param int $upper_bound Number under which we find our solution
     *
     * @return int Prime number sum of consecutive primes
     */
    private function findConsecutivePrimeSum($upper_bound){
        // generate primes and consecutive sum array
        $primes = array();
        $sums = array(0); // first element 0 so I can simplify window generation
        $tmp_sum = 0;
        for ($i = 2; $i < $upper_bound; $i++) {
            if ($this->isPrime($i)) {
                $primes[] = $i;
                $tmp_sum += $i;
                $sums[] = $tmp_sum;
                if ($this->isPrime($tmp_sum) && $tmp_sum < $upper_bound) {
                    // echo "sum and prime: $tmp_sum \n"; // debug
                }
                if ($tmp_sum > $upper_bound) { // we don't really need all these primes
                    break;
                }
            }
        }
        
        $most_consec = 0;
        $answer = 41; // initial value
        // bounds arbitrarily chosen but logically because if we start too high we will get fewer consec sums before we hit our $upper_bound
        $sum_lower_bound = 100; 
        $sum_upper_bound = 600;
        for ($win_start = 0; $win_start < $sum_lower_bound; $win_start++) {
            for ($win_end = 534; $win_end < $sum_upper_bound; $win_end++) { // first 536 primes is the prime 958577
                if (isset($sums[$win_end])) {
                    $test_sum = $sums[$win_end] - $sums[$win_start];
                    $test_cnt = $win_end - $win_start;
                    if ($this->isPrime($test_sum) && $test_sum < $upper_bound) {
                        if ($test_cnt > $most_consec) {
                            $most_consec = $test_cnt;
                            $answer = $test_sum;
                            // echo "Found $test_sum with $test_cnt members\n"; // debug          
                        }
                    }
                } else {
                    break;
                }
            }
        }
        
        return $answer;
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


}
