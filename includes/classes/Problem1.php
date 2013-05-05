<?php
/**
 * Project Euler - Problem 1
 *
 * If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9.
 * The sum of these multiples is 23. Find the sum of all the multiples of 3 or 5 below 1000.
 *
 * @category ProjectEuler
 * @package Problem1
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=1
 *
 */

class Problem1 extends Problem_Abstract
{
    /**
     * Maximum number we should sum below
     * @const int NUMBER_MAX
     */
    const NUMBER_MAX = 1000;

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->sumThreeAndFiveMultiples(self::NUMBER_MAX);
    }

    /**
     * Return sum of all numbers that are multiples of 3 or 5 below limit
     *
     * @param int $limit maximum number we should sum below
     *
     * @return int
     */
    private function sumThreeAndFiveMultiples($limit)
    {
        $outputSum = 0;
        for ($i=1; $i < $limit; $i++){
            if ($i % 3 === 0 || $i % 5 === 0) {
                $outputSum += $i;
            }
        }
        return $outputSum;
    }
}
