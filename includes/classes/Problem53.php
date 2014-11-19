<?php
/**
 * Project Euler - Problem 53
 *
 * Combinatoric selections
 *
 * There are exactly ten ways of selecting three from five, 12345:
 * 123, 124, 125, 134, 135, 145, 234, 235, 245, and 345
 * In combinatorics, we use the notation, 5C3 = 10.
 * In general,
 * 
 * <sup>n</sup>C<sub>r</sub> = n!/(r!(n−r)!)
 * , where r ≤ n, n! = n*(n−1) * ... * 3 * 2 * 1, and 0! = 1.
 * 
 * It is not until n = 23, that a value exceeds one-million: <sup>23</sup>C<sub>10</sub> = 1144066.
 * How many, not necessarily distinct, values of  <sup>n</sup>C<sub>r</sub>, for 1 ≤ n ≤ 100, are greater than one-million? 
 *
 * @category ProjectEuler
 * @package Problem53
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=53
 *
 */
class Problem53 extends Problem_Abstract
{
    /**
     * Greatest value of n and r
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 100;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

        // $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);

        if (!extension_loaded('bcmath')) {
            // Placeholder for any extensions required for this problem's code
            die('BCMath extension required. See http://www.php.net/manual/en/book.bc.php .');
        }
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->countCombinatoricSelections(self::UPPER_BOUND);
    }

    /**
     * Count how many combinatoric selections below 1000000 where r <= n and n <= 100 
     *
     * @param string $upper_bound n and r < $upper_bound
     *
     * @return int Count of selections
     */
    private function countCombinatoricSelections($upper_bound)
    {
        $cnt = 0;
        for ($n = 1; $n <= $upper_bound; $n++) {
            for ($r = 1; $r <= $n; $r++) {
                $n_fact = $this->bcfact($n);
                $n_r_fact = $this->bcfact($n-$r);
                $r_fact = $this->bcfact($r);
                $denom = bcmul($r_fact, $n_r_fact);
                $c = bcdiv($n_fact, $denom);
                if ($c > 1000000) {
                   $cnt++;
                }
            }
        }
        return $cnt;
    }


    /**
     * Calculate the factorial when the result is outside 
     * of normal integer bounds
     *
     * @param int $n Number to raise to its factorial
     *
     * @return string $n!
     */
    private function bcfact($n) {
        static $fact_map = array();

        if (isset($fact_map[$n])) {
            return $fact_map[$n];;
        } else {
            $result = '1';
            for ($i = 1; $i <= $n; $i++) {
                $result = bcmul((string) $i, $result);
            }
            $fact_map[$n] = $result;
            return $result;
        }
    }
}
