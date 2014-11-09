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
     * Description of input
     * @const string INPUT
     */
    // const UPPER_BOUND = 100; // Test value, answer is 13
    // const UPPER_BOUND = 10000; // Test value
    const UPPER_BOUND = 1000000; // Problem value

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
        return $this->countCircularPrimes(self::UPPER_BOUND);
    }

    /**
     * Count "Circular Primes" smaller than an upper bound
     *
     * @param string $upper_bound Test up to this number
     *
     * @return int How many circular primes under $upper_bound?
     */
    private function countCircularPrimes($upper_bound){
        $circular_primes = array(); 
        for ($i = 1; $i < $upper_bound; $i++) {
            if ($this->isPrime($i) && !in_array($i, $circular_primes)) {
                $possible_circular_primes = array($i);
                $a = (string) $i;
                $cnt = strlen($a);
                $j = 1;
                while ($j < $cnt) {
                    // pop the last letter off and move to the front
                    $a_front = substr($a, 0, -1);
                    $a_last = substr($a, -1);
                    $a = $a_last.$a_front; 
                    if ($this->isPrime((int)$a)) {
                        $possible_circular_primes[] = (int)$a;
                    } else {
                        break;
                    } 
                    $j++;
                }
                if (count($possible_circular_primes) == $cnt) {
                    // echo "Circular primes added: "; // Debug
                    // echo implode(",", $possible_circular_primes)."\n"; // Debug
                    $circular_primes = array_merge($circular_primes, $possible_circular_primes);
                }
            }
        }
        
        $circular_primes = array_unique($circular_primes);
        asort($circular_primes);
        // echo "\nAll Circular Primes under $upper_bound:\n"; // Debug
        // echo var_export($circular_primes)."\n"; // Debug
        return count($circular_primes);
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
