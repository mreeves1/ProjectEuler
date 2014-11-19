<?php
/**
 * Project Euler - Problem 52
 *
 * Permuted multiples
 *
 * It can be seen that the number, 125874, and its double, 251748, contain exactly the same digits, but in a different order.
 * Find the smallest positive integer, x, such that 2x, 3x, 4x, 5x, and 6x, contain the same digits. 
 *
 * @category ProjectEuler
 * @package Problem52
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=52
 *
 */
class Problem52 extends Problem_Abstract
{
    /**
     * Description of input
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 10000000;

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
        return $this->findPermutedMultiples(self::UPPER_BOUND);
    }

    /**
     * Find the smallest positive integer where a number
     * x, 2x, 3x, 4x, 5x, 6x have all the same digits
     *
     * @param string $upper_bound
     *
     * @return int
     */
    private function findPermutedMultiples($upper_bound)
    {
        for ($i = 100000; $i < $upper_bound; $i++) {
            $x1 = $this->rsortInt($i);
            $x2 = $this->rsortInt($i * 2);
            $x3 = $this->rsortInt($i * 3);
            $x4 = $this->rsortInt($i * 4);
            $x5 = $this->rsortInt($i * 5);
            $x6 = $this->rsortInt($i * 6);
            if ($x1 == $x2 && $x1 == $x3 && $x1 == $x4 && $x1 == $x5 && $x1 == $x6) {
                return $i;
            }
        }
    }

    /**
     * Take an integer, turn it into a string and reverse sort it
     *
     * @param int $int
     *
     * @return string 
     */
    private function rsortInt($int) 
    {
        $a = str_split((string) $int);
        rsort($a);
        $str = implode("", $a);
        return $str;
    }
}
