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
     * Project Euler says each problem should take no more than 1 minute. 
     * If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method to control how long it 
     * takes for the script to timeout
     */
    const TIMEOUT_OVERRIDE = 60;

    /**
     * Project Euler is silent on space complexity. PHP uses a LOT of memory for arrays. 
     * Something like 20x what you would expect. 
     * @const int MEMORY_OVERRIDE Used with an override method to control how much memory
     * the script is allowed to consume.
     */
    const MEMORY_OVERRIDE = '64M';

    /**
     * Description of input
     * @const string INPUT
     */
    // const UPPER_BOUND = 1000000;
    const UPPER_BOUND = 1000; // Test case, should be 953

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

        // $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);

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
        return $this->findSomething(self::UPPER_BOUND);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findSomething($upper_bound){
        $primes = array();
        for ($i = 2; $i < $upper_bound; $i++) {
            if ($this->isPrime($i)) {
                $primes[] = $i;
            }
        }

        $val = 41;
        $pos = array_search($val, $primes);
        

        for ($start = 0; $start < $pos - 3; $start++) {
            $prime_sum = 0;
            for ($end = $start + 3; $end < $pos - 1; $end++) {
                echo "testing ".var_export($prime_seq, true)."\n";
                $prime_seq = array_slice($primes, $start, ($end - $start));
                $prime_test = array_sum($prime_seq);
                if ($val == $prime_test) {
                    echo var_export($prime_seq, true)."\n";
                    return $val;
                }
            }
        }
           


        return "crap";;
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
