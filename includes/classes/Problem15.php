<?php
/**
 * Project Euler - Problem 15
 *
 * Lattice paths
 *
 * Starting in the top left corner of a 2x2 grid, and only being able to move to the right and down, there are exactly 6 routes to the bottom right corner.
 * 
 * 
 * How many such routes are there through a 20x20 grid? 
 *
 * @category ProjectEuler
 * @package Problem15
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=15
 *
 */
class Problem15 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * X and Y bounds of grid. 
     * I.e. for a 20x20 grid this is 20
     *
     * Note: if the grid has bounds of 20 that means it has 20 edges but 21 nodes!
     * 
     * @const int INPUT
     */
    const INPUT = 2;
    const INPUT = 2;

    /** Store the resulting routes in an array */
    // private $paths = array();

    /** Count found routes */
    private $pathCount = 0;

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
        return $this->countRoutes(self::INPUT);
    }

    /**
     * Count routes through a grid with x and y dimentions of $bounds
     *
     * @param int $bounds Dimensions of grid
     *
     * @return int Number of routes
     */
    private function countRoutes($bounds){
        $this->followPath(0, 0, $bounds);
        return $this->pathCount;
    }

    private function followPath($x, $y, $bounds) {

    }
}
