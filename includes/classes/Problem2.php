<?php
/**
 * Project Euler - Problem 2
 *
 * Each new term in the Fibonacci sequence is generated by adding the previous two terms.
 * By starting with 1 and 2, the first 10 terms will be: 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, ...
 *
 * By considering the terms in the Fibonacci sequence whose values do not exceed four million,
 * find the sum of the even-valued terms.
 *
 * @category ProjectEuler
 * @package Problem2
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=2
 *
 */
class Problem2 extends Problem_Abstract
{
    /**
     * Maximum number we should sum below
     * @const int NUMBER_MAX
     */
    const NUMBER_MAX = 4000000;

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->sumEvenFibonacciTerms(self::NUMBER_MAX);
    }

    /**
     * Return sum of all even Fibonacci Sequence terms below limit
     *
     * @param int $limit maximum number we should sum below
     *
     * @return int
     */
    private function sumEvenFibonacciTerms($limit)
    {
        $outputSum = 2; // start with the 2 value that is the 2nd item in our sequence
        $fibSequence = array(1,2);
        $currentIndex = 0;
        while ($fibSequence[$currentIndex + 1] < $limit) {
            $number1 = $fibSequence[$currentIndex];
            $number2 = $fibSequence[$currentIndex + 1];
            $numberNew = $number1 + $number2;
            if ($numberNew % 2 === 0){
                $outputSum += $numberNew;
            }
            $fibSequence[] = $numberNew;
            $currentIndex++;
        }
        return $outputSum;
    }
}
