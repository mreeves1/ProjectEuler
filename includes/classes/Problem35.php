<?php
/**
 * Project Euler - Problem 35
 *
 * Circular primes
 *
 * The number, 197, is called a circular prime because all rotations of the digits: 197, 971, and 719, are themselves prime.
 * There are thirteen such primes below 100: 2, 3, 5, 7, 11, 13, 17, 31, 37, 71, 73, 79, and 97.
 * How many circular primes are there below one million? 
 *
 * @category ProjectEuler
 * @package Problem35
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=35
 *
 */
class Problem35 extends Problem_Abstract
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
    // const UPPER_BOUND = 100; // Test value, answer is 13
    const UPPER_BOUND = 10000; // Test value
    // const UPPER_BOUND = 1000000; // Problem value

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
        return $this->countCircularPrimes(self::UPPER_BOUND);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function countCircularPrimes($upper_bound){
        $prime_count = array(); // the key will be the prime ordered and the value will be a count
        for ($i = 1; $i < $upper_bound; $i++) {
            if ($this->isPrime($i)) {
                // echo $i . " is prime.\n";
                $a = str_split((string) $i);
                rsort($a); // reverse sort to prevent leading zeroes
                $k = implode("", $a);
                if (isset($prime_count[$k])) {
                    $prime_count[$k] = $prime_count[$k] + 1;
                } else {
                    $prime_count[$k] = 1;
                }
            }
        }
        ksort($prime_count);

        $circular_prime_count = 0;
        echo var_export($prime_count, true);
        foreach ($prime_count as $prime => $count) {
            $test_count = $this->fact(strlen((string) $prime));
            if ($test_count == $count || $prime == 11) { // wacky edge case 11 - may need to refine thiss
                $circular_prime_count += $count;
                echo $prime . " is a circular prime (sorted) with ".$count." primes \n";
            }
        }

        return $circular_prime_count;
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

    private function fact($n) {
        static $fact_map = array();
        
        if (isset($fact_map[$n])) {
            return $fact_map[$n];;
        } else {
            $result = 1;
            for ($i = 1; $i <= $n; $i++) {
                $result *= $i;
            }
            $fact_map[$n] = $result; 
            return $result;
        }
    }

}
