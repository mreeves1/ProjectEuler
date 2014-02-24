<?php
/**
 * Project Euler - Problem 6
 *
 * Square of the sum - the sum of the squares
 *
 * The sum of the squares of the first ten natural numbers is,
 * 1^2 + 2^2 + ... + 10^2 = 385
 *
 * The square of the sum of the first ten natural numbers is,
 * (1 + 2 + ... + 10)^2 = 55^2 = 3025
 *
 * Hence the difference between the sum of the squares of the first ten natural numbers
 * and the square of the sum is 3025 - 385 = 2640.
 *
 * Find the difference between the sum of the squares of the first one hundred natural numbers and the square of the sum.
 *
 * @category ProjectEuler
 * @package Problem6
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=6
 *
 */
class Problem6 extends Problem_Abstract
{
    /**
     * Natural number upper bound
     * @const int INPUT
     */
    const INPUT = 100;

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->sumSquareDifference(self::INPUT);
    }

    /**
     * square of the sum of the first X positive integers - sum of the squares of the  first X positive integers
     *
     * @param string $number The number of positive integers to use
     * @return int square of the sum - sum of the squares
     */
    private function sumSquareDifference($number){
        $sumOfSquares = 0;
        $squareOfSumsTmp = 0;
        for ($i = 1; $i <= $number; $i++){
            $sumOfSquares += $i * $i;
            $squareOfSumsTmp += $i;
        }
        $squareOfSums = $squareOfSumsTmp * $squareOfSumsTmp;

        return ($squareOfSums - $sumOfSquares);
    }
}
