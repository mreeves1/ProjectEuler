<?php
/**
 * Project Euler - Problem 63
 *
 * Powerful digit counts
 *
 * The 5-digit number, 16807=7^5, is also a fifth power.
 * Similarly, the 9-digit number, 134217728=8^9, is a ninth power.
 * How many n-digit positive integers exist which are also an nth power?
 *
 * @category ProjectEuler
 * @package Problem63
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=63
 *
 */
class Problem63 extends Problem_Abstract
{
    public function __construct()
    {
        parent::__construct(); 

        if (!extension_loaded('bcmath')) {
            // Placeholder for any extensions required for this problem's code
            die('BCMath extension required. See http://www.php.net/manual/en/book.bc.php .');
        }
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findPowerfulDigitCount();
    }

    /**
     * Find how many n-digit positive integers exist which are also nth powers
     * Example: 7^5 = 16807 : 5th power with 5 digits 
     *
     * @return int count of n-digit and nth power integers
     */
    private function findPowerfulDigitCount(){
        $sum = 0;
        for ($n = 1; $n < 40; $n++) { // power
            for ($i = 1; $i <= 9; $i++) { // base (clearly it has to be < 10)
                $number = bcpow($i, $n);
                $digits = strlen($number);
                if ($digits == $n) {
                    // echo "$i to the $n is $number with $digits digits \n"; // debug
                    $sum++;
                }
            }
        }
        return $sum;
    }
}
