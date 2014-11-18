<?php
/**
 * Project Euler - Problem 55
 *
 * Lychrel numbers
 *
 * If we take 47, reverse and add, 47 + 74 = 121, which is palindromic.

 * Not all numbers produce palindromes so quickly. For example,

 * 349 + 943 = 1292,

 * 1292 + 2921 = 4213

 * 4213 + 3124 = 7337

 * That is, 349 took three iterations to arrive at a palindrome.

 * Although no one has proved it yet, it is thought that some numbers, like 196, never produce a palindrome. A number that never forms a palindrome through the reverse and add process is called a Lychrel number. Due to the theoretical nature of these numbers, and for the purpose of this problem, we shall assume that a number is Lychrel until proven otherwise. In addition you are given that for every number below ten-thousand, it will either (i) become a palindrome in less than fifty iterations, or, (ii) no one, with all the computing power that exists, has managed so far to map it to a palindrome. In fact, 10677 is the first number to be shown to require over fifty iterations before producing a palindrome: 4668731596684224866951378664 (53 iterations, 28-digits).

 * Surprisingly, there are palindromic numbers that are themselves Lychrel numbers; the first example is 4994.

 * How many Lychrel numbers are there below ten-thousand?

 * NOTE: Wording was modified slightly on 24 April 2007 to emphasise the theoretical nature of Lychrel numbers. 
 *
 * @category ProjectEuler
 * @package Problem55
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=55
 *
 */
class Problem55 extends Problem_Abstract
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
    const INPUT = '';

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
        return $this->findSomething(self::INPUT);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findSomething($number){

        return;
    }
}
