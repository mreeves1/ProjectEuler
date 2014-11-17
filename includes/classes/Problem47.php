<?php
/**
 * Project Euler - Problem 47
 *
 * Distinct primes factors
 *
 * The first two consecutive numbers to have two distinct prime factors are:
 * 14 = 2 × 715 = 3 × 5
 * The first three consecutive numbers to have three distinct prime factors are:
 * 644 = 2² × 7 × 23645 = 3 × 5 × 43646 = 2 × 17 × 19.
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
