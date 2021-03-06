<?php
/**
 * Project Euler - Problem 4
 *
 * Find the largest palindrome made from the product of two 3-digit numbers.
 *
 * A palindromic number reads the same both ways.
 * The largest palindrome made from the product of two 2-digit numbers is 9009 = 91 99.
 * Find the largest palindrome made from the product of two 3-digit numbers.
 *
 * @category ProjectEuler
 * @package Problem4
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=4
 *
 */
class Problem4 extends Problem_Abstract
{
    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow, make this larger.
     * @const int PROBLEM_TIMEOUT_OVERRIDE Used with set_timeout_limit to extend timeout if computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 120;

    /**
     * Smallest number to test
     * @const int INPUT
     */
    const LOWER_BOUND = 100;

    /**
     * Largest number to test
     * @const int INPUT
     */
    const UPPER_BOUND = 999;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct();
        set_time_limit(self::PROBLEM_TIMEOUT_OVERRIDE);
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findLargestPalindrome(self::LOWER_BOUND, self::UPPER_BOUND);
    }

    /**
     * Test if a number is a palindrome (ie 12721 is a palindrome because it looks the same reversed)
     *
     * @param int $number number to test
     *
     * @return bool result of test of $number for being a palindrome
     */
    private function isPalindrome($number){
        $items = str_split((string) $number); // convert number to array of digits
        $arraySize = count($items);
        $upperBound = floor(((int)$arraySize)/2);
        for ($i = 0; $i <= $upperBound; $i++){
            if($items[$i] !== $items[$arraySize - $i - 1]){
                return false;
            }
        }
        return true;
    }

    /**
     * Find largest palindrome within bounds.
     *
     * @param int $upperBound largest number to test
     * @param int $lowerBound smallest number to test
     *
     * @return int largest palindrome
     */
    private function findLargestPalindrome($lowerBound, $upperBound){
        $largestPalindrome = 0;
        for ($i = $upperBound; $i >= $lowerBound; $i--){
            for ($j = $upperBound; $j >= $lowerBound; $j--){
                if ($this->isPalindrome($i * $j)){
                    if (($i * $j) > $largestPalindrome) {
                        $largestPalindrome = $i * $j;
                    }
                }
            }
        }
        return $largestPalindrome;
    }
}





