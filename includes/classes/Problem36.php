<?php
/**
 * Project Euler - Problem 36
 *
 * Double-base palindromes
 *
 * The decimal number, 585 = 10010010012 (binary), is palindromic in both bases.
 * Find the sum of all numbers, less than one million, which are palindromic in base 10 and base 2.
 * (Please note that the palindromic number, in either base, may not include leading zeros.) 
 *
 * @category ProjectEuler
 * @package Problem36
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=36
 *
 */
class Problem36 extends Problem_Abstract
{
    /**
     * Description of input
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 1000000;

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
        return $this->sumPalindromeNumbers(self::UPPER_BOUND);
    }

    /**
     * Sum all base 10 numbers up to $upper_bound where both the base 10 and base 2 
     * representations are palindromes. Ignore any base 2 versions that have a leading 0.  
     *
     * @param int $upper_bound
     *
     * @return int sum of all base 10 palindromic numbers
     */
    private function sumPalindromeNumbers($upper_bound){
        $sum = 0;
        for ($i = 1; $i < $upper_bound; $i++) { // are single digits palindromic?
            if($this->isPalindrome($i)) {
                $i_base2 = base_convert($i, 10, 2);
                if ($this->isPalindrome($i_base2)) {
                    $sum += $i;
                    // echo "Palindrome pair: ".$i." and ".$i_base2."\n"; // debug
                }
            }
        }
        return $sum;
    }

    /**
     * Test if a number is palindromic
     *
     * @param int $number The number to test
     *
     * @return boolean Is the number palindromic or not?
     */
    private function isPalindrome($number) {
        $number = (string) $number;

        // leading zeroes case
        if (substr($number, 0, 1) == 0) { 
            return false;
        }
        $comp_len = ceil(strlen($number)/2);
        $front = substr($number,0,$comp_len);
        $back = strrev(substr($number, $comp_len * -1, $comp_len));
        return ($front == $back);
    }
}
