<?php
/**
 * Project Euler - Problem 48
 *
 * Self powers
 *
 * The series, 11 + 22 + 33 + ... + 1010 = 10405071317.
 * Find the last ten digits of the series, 11 + 22 + 33 + ... + 10001000. 
 *
 * @category ProjectEuler
 * @package Problem48
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=48
 *
 */
class Problem48 extends Problem_Abstract
{
    /**
     * Description of input
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 1000; // Problem argument
    // const UPPER_BOUND = 10; // Test argument, result should be "0405071317"

    public function __construct()
    {
        parent::__construct(); 

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
        return $this->findSelfPowerSummationLastTenDigits(self::UPPER_BOUND);
    }

    /**
     * Find the last ten digits of the series 1^1 + 1^2 + 1^3 ... $upper_bound^$upper_bound
     *
     * @param string $upper_bound
     *
     * @return string last ten digits of the series summation
     */
    private function findSelfPowerSummationLastTenDigits($upper_bound){
        $sum = 0;
        for ($i = 1; $i <= $upper_bound; $i++) {
            $a = bcpow((string)$i, (string)$i);
            $sum = bcadd((string)$sum, $a);
        }

        // echo $sum."\n"; // debug
        return substr($sum, -10, 10);
    }
}
