<?php
/**
 * Project Euler - Problem 92
 *
 * Square digit chains
 *
 * A number chain is created by continuously adding the square of the digits in a number to form a new number until it has been seen before.
 * For example,
 * 44 → 32 → 13 → 10 → 1 → 1
 * 85 → 89 → 145 → 42 → 20 → 4 → 16 → 37 → 58 → 89
 * Therefore any chain that arrives at 1 or 89 will become stuck in an endless loop. What is most amazing is that EVERY starting number will eventually arrive at 1 or 89.
 * How many starting numbers below ten million will arrive at 89? 
 *
 * @category ProjectEuler
 * @package Problem92
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=92
 *
 */
class Problem92 extends Problem_Abstract
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
     * Description of input
     * @const string INPUT
     */
    // const UPPER_BOUND = 1000;
    const UPPER_BOUND = 10000000;

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
        return $this->findSomething(self::UPPER_BOUND);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findSomething($upper_bound)
    {
        $count = 0;
        for ($i = 2; $i < $upper_bound; $i++) {
            $count += $this->testNum($i) ? 1 : 0;
            // if ($i % 100000 == 0) { echo "tested $i\n"; } // debug
        }
        return $count;
    }

    // TODO: Improve this method - we could order all the digits to tokenize this to reduce ops
    //       That is a number like 145 and 541 and 415 will all converge to the same number... 
    private function testNum($num)
    {
        /*
        // closures + array_map = slow :-(
        $square = function($val) {
            return pow($val, 2);
        };
        */
 
        if ($num == 89) {
            return true;
        } elseif ($num == 1) {
            return false;
        } else {
            // get next number
            $digits = str_split((string) $num);
            // $new_num = array_sum(array_map($square, $digits)); // part of closure solution
            $new_num = 0;
            $d_cnt = count($digits);
            for ($i = 0; $i < $d_cnt; $i++) {
                $new_num += pow($digits[$i],2);
            }
            return $this->testNum($new_num);
        }
    }
}
