<?php
/**
 * Project Euler - Problem 47
 *
 * Distinct primes factors
 *
 * The first two consecutive numbers to have two distinct prime factors are:
 * 14 = 2 × 7
 * 15 = 3 × 5
 * The first three consecutive numbers to have three distinct prime factors are:
 * 644 = 2² × 7 × 23
 * 645 = 3 × 5 × 43
 * 646 = 2 × 17 × 19.
 * Find the first four consecutive integers to have four distinct prime factors. What is the first of these numbers? 
 *
 * @category ProjectEuler
 * @package Problem47
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=47
 *
 */
class Problem47 extends Problem_Abstract
{
    /**
     * Project Euler says each problem should take no more than 1 minute. 
     * If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method to control how long it 
     * takes for the script to timeout
     */
    const TIMEOUT_OVERRIDE = 240;

    /**
     * Project Euler is silent on space complexity. PHP uses a LOT of memory for arrays. 
     * Something like 20x what you would expect. 
     * @const int MEMORY_OVERRIDE Used with an override method to control how much memory
     * the script is allowed to consume.
     */
    const MEMORY_OVERRIDE = '64M';

    /**
     * Input value
     * @const int INPUT
     */

    // const INPUT = 2; // Test 1: Answer should be 14
    // const INPUT = 3; // Test 2: Answer should be 644
    const INPUT = 4;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct();
        $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     * @return int
     */
    public function execute()
    {
        return $this->findConsecutiveNumbersWithNDistinctPrimeFactors(self::INPUT);
    }

    /**
     * Find $n consecutive numbers with $n distinct prime factors.
     *
     * @param int $n Number of consecutive integers with same number of unique prime factors
     * @return int First integer in set of consecutive numbers
     */
    private function findConsecutiveNumbersWithNDistinctPrimeFactors($n){

        // Pre-populate primes
        $primes = [];
        for ($i = 2; $i < 200000; $i++) {
            if ($this->isPrime($i)) {
                $primes[$i] = $i;
            }
        }

        $sequence = [];
        for ($j = 2; $j < 200000; $j++) {
            if (isset($primes[$j])) {
                // echo "skipping prime $j <br>\n"; // debug
                $sequence = [];
                continue;
            }
            $factors = [];
            $test = $j;
            while ($test > 1) {
                foreach ($primes as $p) {
                    if ($test % $p == 0) {
                        if (!in_array($p, $factors)) {
                            $factors[] = $p;
                        }
                        $test = $test / $p;
                        if (count($factors) > $n) {
                            // echo "$j has too many factors<br>\n"; // debug
                            break 2;
                        } elseif ($test == 1) {
                            if (count($factors) == $n) {
                                $sequence[] = $j;
                                if (count($sequence) == $n) {
                                    // echo "found numbers: ".implode($sequence, ', ')."<br>\n"; // debug
                                    return $sequence[0];
                                }
                            } else { // reset
                                $sequence = [];
                            }
                            break 2;
                        }
                    }
                }
            }
            // echo "$j has factors of ".implode(", ", $factors)."<br>\n"; // debug
        }
    }

    /**
     * Test for Prime-ness (cribbed from problem 50)
     *
     * @param string $n Number to test for primality
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
