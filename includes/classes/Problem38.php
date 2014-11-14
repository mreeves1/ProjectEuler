<?php
/**
 * Project Euler - Problem 38
 *
 * Pandigital multiples
 *
 * Take the number 192 and multiply it by each of 1, 2, and 3:
 * 192 * 1 = 192
 * 192 * 2 = 384
 * 192 * 3 = 576
 * By concatenating each product we get the 1 to 9 pandigital, 192384576. We will call 192384576 the concatenated product of 192 and (1,2,3)
 * The same can be achieved by starting with 9 and multiplying by 1, 2, 3, 4, and 5, giving the pandigital, 918273645, which is the concatenated product of 9 and (1,2,3,4,5).
 * What is the largest 1 to 9 pandigital 9-digit number that can be formed as the concatenated product of an integer with (1,2, ... , n) where n  1? 
 *
 * @category ProjectEuler
 * @package Problem38
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=38
 *
 */
class Problem38 extends Problem_Abstract
{

    /**
     * Description of input
     * @const string INPUT
     */
    const UPPER_BOUND = 1000000;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findLargestPandigitalMultiple(self::UPPER_BOUND);
    }

    /**
     * Find findLargestPandigitalMultiple
     *
     * @param string $number_max
     *
     * @return int Largest Pandigital Product
     */
    private function findLargestPandigitalMultiple($number_max)
    {
        $largest_pandigital = 0;
        for ($i = 9; $i <= $number_max; $i++) {
            $possible_pd = $this->getPandigitalProduct($i);
            if ($possible_pd && $possible_pd > $largest_pandigital) {
                $largest_pandigital = $possible_pd;
            }
        }
        return $largest_pandigital;
    }

    /**
     * Find getPandigitalMultiple
     *
     * @param string $number
     *
     * @return int Pandigital Product or false (a bit ghetto...)
     */
    private function getPandigitalProduct($number) 
    {
        $n = 10; // I don't think we need any n that is larger
        $goal = '987654321';
        $solution = '';
        for ($i = 1; $i <= $n; $i++) {
            $tmp = (string) ($number * $i);
            $solution .= $tmp;
            $sol_array = str_split($solution);
            arsort($sol_array); // stupid leading zeroes means reverse sorting
            $solution_sorted = implode("", $sol_array); // sorted
            if ($solution_sorted == $goal) {
                // echo "num = $number, i = $i, solution = $solution\n"; // debug
                return (int)$solution;
            }
            if (strlen($solution) > 9) {
                return false;
            }
        }
        return false;        
    }
}
