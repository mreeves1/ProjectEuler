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
     * Project Euler says each problem should take no more than 1 minute. 
     * If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method to control how long it 
     * takes for the script to timeout
     */
    const TIMEOUT_OVERRIDE = 300;

    /**
     * Project Euler is silent on space complexity. PHP uses a LOT of memory for arrays. 
     * Something like 20x what you would expect. 
     * @const int MEMORY_OVERRIDE Used with an override method to control how much memory
     * the script is allowed to consume.
     */
    const MEMORY_OVERRIDE = '512M';

    /**
     * Description of input
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 987654321; // Problem value
    # const UPPER_BOUND = 2200; // Testing value

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

        $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);

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
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findLargestPandigitalPrime($upper_bound){
        $max = 0;
        for ($i = 1; $i <= $upper_bound; $i++){
            if ($this->isPrime($i) && $this->isPandigital($i)) {
                // echo $i . " is prime and pandigital.\n"; // debug         
                $max = ($i > $max) ? $i : $max;
            }
        }
        return $max; 
    }

    private function isPrime($n) {
        static $primes = array(2, 3);
        if ($n === 1) {
            return false;
        } elseif ($n === 2) {
            return true;
        } else {
            foreach ($primes as $prime) {
                if ($n % $prime === 0) {
                    return false;
                }
                if ($prime > sqrt($n)) {
                    break;
                }
            }
            $primes[] = $n;
            // echo $n." is prime\n";
            return true;
        }
    }

    private function isPandigital($n) {
        $digits = str_split($n);
        sort($digits);
        $test_range = range(1, count($digits));
        // if ($n == 2143) {
        //    var_dump($digits);
        //    var_dump($test_range);
        // }
        return ($digits == $test_range);
    }

 

}
