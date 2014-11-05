<?php
/**
 * Project Euler - Problem 81
 *
 * Path sum: two ways
 *
 * In the 5 by 5 matrix below, the minimal path sum from the top left to the bottom right, by only moving to the right and down, is indicated in bold red and is equal to 2427.
 * 131 673 234 103  18
 * 201  96 342 965 150 
 * 630 803 746 422 111
 * 537 599 497 121 956
 * 805 732 524  37 331
 * 
 * Find the minimal path sum, in <a href="https://projecteuler.net/project/resources/p081_matrix.txt">matrix.txt</a> (right click and "Save Link/Target As..."), a 31K text file containing a 80 by 80 matrix, from the top left to the bottom right by only moving right and down. 
 *
 * @category ProjectEuler
 * @package Problem81
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=81
 *
 */
class Problem81 extends Problem_Abstract
{
    /**
     * Project Euler says each problem should take no more than 1 minute. 
     * If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method to control how long it 
     * takes for the script to timeout
     */
    const TIMEOUT_OVERRIDE = 360;

    /**
     * Project Euler is silent on space complexity. PHP uses a LOT of memory for arrays. 
     * Something like 20x what you would expect. 
     * @const int MEMORY_OVERRIDE Used with an override method to control how much memory
     * the script is allowed to consume.
     */
    const MEMORY_OVERRIDE = '64M';

    /**
     * File with 5000+ first names (comma delimited and quoted)
     * @const string INPUT
     */
    const INPUT_FILE = 'files/problem81_matrix_problem.txt';
    // const INPUT_FILE = 'files/problem81_matrix_test.txt'; // Test case where result should be 2427

    private $minPathSum = 2147483647; // arbitrarily large init value = max 32 bit int 
 
    private $path_counter = 0; 
   
    private $discard_counter = 0; 

    private $matrix = array();
 
    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

        $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);

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
        return $this->findMinimalPathSum(self::INPUT_FILE);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findMinimalPathSum($input_file){
        $this->initMatrix($input_file);
        $maxDim = count($this->getMatrix());
        return $this->traverseMatrix($maxDim - 1, $maxDim - 1, 0);
        // return $this->minPathSum;
    }

    private function initMatrix($input_file) {
        $fh = fopen($input_file, "r");
        $y = 0;
        while (($row = fgetcsv($fh, 0, ",", "'")) !== false) {
            $this->matrix[$y] = $row;
            $y++;
        }
        // echo var_export($this->matrix, true); // debug
    }

    private function getMatrix() {
        return $this->matrix;
    }

    private function traverseMatrix($x, $y, $sum) {
        $matrix = $this->getMatrix();
        if (isset($matrix[$y]) && isset($matrix[$y][$x])) {
            $sum += $matrix[$y][$x];
            echo "Coordinates (".$x.",".$y."), Sum is now ".$sum."\n";
        }
        if ($x == 0 && $y == 0) { // end condition
            return $sum;
        } else {
            $newY = $y > 0 ? $matrix[$y-1][$x] : PHP_INT_MAX;
            $newX = $x > 0 ? $matrix[$y][$x-1] : PHP_INT_MAX;
            echo "new possibles: (".$newX.",".$newY.")\n";

            if ($newY < $newX) {
                return $this->traverseMatrix($x, $y-1, $sum);
            } else {
                return $this->traverseMatrix($x-1, $y, $sum);
            }
        } 
    }
}
