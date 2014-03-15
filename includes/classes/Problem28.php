<?php
/**
 * Project Euler - Problem 28
 *
 * Number spiral diagonals
 *
 * Starting with the number 1 and moving to the right in a clockwise direction a 5 by 5 spiral is formed as follows:
 * 21 22 23 24 25
 * 20  7  8  9 10
 * 19  6  1  2 11
 * 18  5  4  3 12
 * 17 16 15 14 13
 *
 * It can be verified that the sum of the numbers on the diagonals is 101.
 * What is the sum of the numbers on the diagonals in a 1001 by 1001 spiral formed in the same way? 
 *
 * @category ProjectEuler
 * @package Problem28
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=28
 *
 */
class Problem28 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Dimensions of spiral rectangle
     * @const int INPUT
     */
    // const INPUT = 5; // Test Value 
    const INPUT = 1001; // Problem Value 

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
        set_time_limit(self::PROBLEM_TIMEOUT_OVERRIDE);
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
        return $this->findDiagonalSpiralSum(self::INPUT);
    }

    /**
     * Create a spiraling rectangle of numbers with the dimension of $dimension
     * The maximum value corner is the dimension squared then you find the 3 other 
     * corners by subtracting dimension - 1 from the previous corner's value
     *
     * @param string $dimension height and width of number rectangle
     *
     * @return int sum of the diagonals
     */
    private function findDiagonalSpiralSum($dimension){
        $sum = 1; // seed with the center value
        for ($i = 3; $i <= $dimension; $i = $i + 2) {
            // corners are a simple equation
            $sum += 4 * pow($i, 2) - (3 * ($i - 1)) - (2 * ($i - 1)) - ($i - 1);
        }
        return $sum;
    }
}
