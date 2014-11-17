<?php
/**
 * Project Euler - Problem 56
 *
 * Powerful digit sum
 *
 * A googol (10100) is a massive number: one followed by one-hundred zeros; 100100 is almost unimaginably large: one followed by two-hundred zeros. Despite their size, the sum of the digits in each number is only 1.
 * Considering natural numbers of the form, ab, where a, b < 100, what is the maximum digital sum? 
 *
 * @category ProjectEuler
 * @package Problem56
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=56
 *
 */
class Problem56 extends Problem_Abstract
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
