<?php
/**
 * Project Euler - Problem 18
 *
 * Maximum path sum I
 *
 * By starting at the top of the triangle below and moving to adjacent numbers on the row below, the maximum total from top to bottom is 23.
 * 37 4
 * 2 4 6
 * 8 5 9 3
 * That is, 3 + 7 + 4 + 9 = 23.
 * Find the maximum total from top to bottom of the triangle below:
 *
 * 75
 * 95 64
 * 17 47 82
 * 18 35 87 10
 * 20 04 82 47 65
 * 19 01 23 75 03 34
 * 88 02 77 73 07 63 67
 * 99 65 04 28 06 16 70 92
 * 41 41 26 56 83 40 80 70 33
 * 41 48 72 33 47 32 37 16 94 29
 * 53 71 44 65 25 43 91 52 97 51 14
 * 70 11 33 28 77 73 17 78 39 68 17 57
 * 91 71 52 38 17 14 91 43 58 50 27 29 48
 * 63 66 04 68 89 53 67 30 73 16 69 87 40 31
 * 04 62 98 27 23 09 70 98 73 93 38 53 60 04 23
 * NOTE: As there are only 16384 routes, it is possible to solve this problem by trying every route. However, Problem 67, is the same challenge with a triangle containing one-hundred rows; it cannot be solved by brute force, and requires a clever method! ;o) 
 *
 * @category ProjectEuler
 * @package Problem18
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=18
 *
 */
class Problem18 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /** A 2 dimensional array that stores the relationship of the nodes in a binary tree */
    private $nodes = array(); 

    /** Store the resulting paths in an array */
    private $paths = array();


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
     * Wrapper method to output our answer with the appropriate this->nodes input variable
     *
     *
     * @return int
     */
    public function execute()
    {
        // This binary tree has 14 rows and thus there will be 2^14 (16834) paths
        $this->nodes[] = array(75);
        $this->nodes[] = array(95,64);
        $this->nodes[] = array(17,47,82);
        $this->nodes[] = array(18,35,87,10);
        $this->nodes[] = array(20, 4,82,47,65);
        $this->nodes[] = array(19, 1,23,75, 3,34);
        $this->nodes[] = array(88, 2,77,73, 7,63,67);
        $this->nodes[] = array(99,65, 4,28, 6,16,70, 92);
        $this->nodes[] = array(41,41,26,56,83,40,80,70,33);
        $this->nodes[] = array(41,48,72,33,47,32,37,16,94,29);
        $this->nodes[] = array(53,71,44,65,25,43,91,52,97,51,14);
        $this->nodes[] = array(70,11,33,28,77,73,17,78,39,68,17,57);
        $this->nodes[] = array(91,71,52,38,17,14,91,43,58,50,27,29,48);
        $this->nodes[] = array(63,66, 4,68,89,53,67,30,73,16,69,87,40,31);
        $this->nodes[] = array( 4,62,98,27,23, 9,70,98,73,93,38,53,60, 4,23);

        return $this->findMaxPathSum($this->nodes);
    }

    /**
     * Find Maximum Path Sum
     *
     * @param array $nodes An array that represents a binary tree
     *
     * @return int Maximum Path Sum
     */
    private function findMaxPathSum($nodes){
        
        // echo "\nPrint Nodes\n"; // debug
        for ($i = 0; $i < count($nodes); $i++) {
            for ($j = 0; $j < count($nodes[$i]); $j++) {
                // echo "$i,$j: ".$nodes[$i][$j]." . "; // debug
            }
            // echo "\n"; // debug
        }
        $this->findPath(array($nodes[0][0]), 0, 0, $nodes);
        $max = 0;
        $k = 1;
        foreach ($this->paths as $path) {
            $sum = array_sum($path);
            $max = $sum > $max ? $sum : $max;
            // echo $sum."\n"; // debug
            // echo "Path #".$k.": ".implode("->", $path).": "; // debug
            $k++;
        }
        return $max;
    }

    /**
     * Find Path
     *
     * @param array $path The current path to this node represented by an array
     * @param array $nodeRow The y position of the node
     * @param array $nodeCol the x position of the node
     * @param array $nodes A 2 dimensional array that represents a binary tree
     *
     * @return void
     */
    private function findPath($path, $nodeRow, $nodeCol, $nodes) {
        if (!isset($nodes[$nodeRow+1])) {
            $this->paths[] = $path;
        } else {
            $nodeL = $nodes[$nodeRow+1][$nodeCol]; 
            $pathL  = $path;
            array_push($pathL, $nodeL);
            // echo var_export($pathL, true); // debug        
            $this->findPath($pathL, $nodeRow+1, $nodeCol, $nodes);
  
            $nodeR = $nodes[$nodeRow+1][$nodeCol+1]; 
            $pathR = $path;
            array_push($pathR, $nodeR);
            // echo var_export($pathR, true); // debug    
            $this->findPath($pathR, $nodeRow+1, $nodeCol+1, $nodes);
        }
    }
}
