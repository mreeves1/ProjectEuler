<?php
/**
 * Project Euler - Problem 32
 *
 * Pandigital products
 *
 * We shall say that an n-digit number is pandigital if it makes use of all the digits 1 to n exactly once; for example, the 5-digit number, 15234, is 1 through 5 pandigital.
 * 
 * The product 7254 is unusual, as the identity, 39 × 186 = 7254, containing multiplicand, multiplier, and product is 1 through 9 pandigital.
 * 
 * Find the sum of all products whose multiplicand/multiplier/product identity can be written as a 1 through 9 pandigital.
 * 
 * HINT: Some products can be obtained in more than one way so be sure to only include it once in your sum. 
 *
 * @category ProjectEuler
 * @package Problem32
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=32
 *
 */
class Problem32 extends Problem_Abstract
{
    /**
     * Biggest Product we can test
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 9999;

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
        $sumProducts = 0;
        for ($i = 102; $i < self::UPPER_BOUND; $i++) {
            if ($this->testProduct($i)) {
                $sumProducts += $i;
            }
        }
        return $sumProducts;
    }

    /**
     * Test a number and its potential factors to see if all digits taken 
     * together would be considered "pandigital" e.g. include the numbers 
     * 1 to 9 ony once.
     *
     * @param int $number Product to test
     *
     * @return boolean is this product (with its factors) pandigital
     */
    private function testProduct($number)
    {
        $numbers = array('1', '2', '3', '4', '5', '6', '7', '8', '9');
        for ($i = 1; $i < 999; $i++) {
            if ($number % $i === 0) {
                $test = str_split($number.$i.((string)($number/$i)));
                sort($test);
                if ($test === $numbers) {
                    // echo "\n".$number." = "; // debug
                    // echo (string) $i." * "; // debug
                    // echo (string) ($number/$i); // debug
                    
                    return true;
                }
            }
        }
        return false;
    }
}
