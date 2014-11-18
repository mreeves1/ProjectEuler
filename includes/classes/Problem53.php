<?php
/**
 * Project Euler - Problem 53
 *
 * Combinatoric selections
 *
 * There are exactly ten ways of selecting three from five, 12345:
 * 123, 124, 125, 134, 135, 145, 234, 235, 245, and 345
 * In combinatorics, we use the notation, 5C3 = 10.
 * In general,
 * 
 * <sup>n</sup>C<sub>r</sub> = n!/(r!(n−r)!)
 * , where r ≤ n, n! = n*(n−1) * ... * 3 * 2 * 1, and 0! = 1.
 * 
 * It is not until n = 23, that a value exceeds one-million: <sup>23</sup>C<sub>10</sub> = 1144066.
 * How many, not necessarily distinct, values of  <sup>n</sup>C<sub>r</sub>, for 1 ≤ n ≤ 100, are greater than one-million? 
 *
 * @category ProjectEuler
 * @package Problem53
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=53
 *
 */
class Problem53 extends Problem_Abstract
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
