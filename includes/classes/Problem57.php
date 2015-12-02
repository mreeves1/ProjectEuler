<?php
/**
 * Project Euler - Problem 57
 *
 * Square root convergents
 *
 * It is possible to show that the square root of two can be expressed as an infinite continued fraction.
 * √ 2 = 1 + 1/(2 + 1/(2 + 1/(2 + ... ))) = 1.414213...
 * By expanding this for the first four iterations, we get:
 * 1 + 1/2 = 3/2 = 1.5
 * 1 + 1/(2 + 1/2) = 7/5 = 1.4
 * 1 + 1/(2 + 1/(2 + 1/2)) = 17/12 = 1.41666...
 * 1 + 1/(2 + 1/(2 + 1/(2 + 1/2))) = 41/29 = 1.41379...
 * The next three expansions are 99/70, 239/169, and 577/408, but the eighth expansion, 1393/985, is the first example where the number of digits in the numerator exceeds the number of digits in the denominator.
 * In the first one-thousand expansions, how many fractions contain a numerator with more digits than denominator?
 *
 * @category ProjectEuler
 * @package Problem57
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=57
 *
 */
class Problem57 extends Problem_Abstract
{
    /**
     * Description of input
     * @const int INPUT
     */
    const INPUT = 2;

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
        return $this->findLongerNumeratorInSquareRootConvergents(self::INPUT);
    }

    /**
     * Calculate the numerator and denominator of square root convergents.
     *
     * Compute the length of numerator and denominator of 1000 iterations and
     * return the count of how many have a longer numerator than the denominator
     *
     * @param int $square_root we are calculating via convergents
     *
     * @return int count of iterations with a longer numerator
     */
    private function findLongerNumeratorInSquareRootConvergents($square_root){
        $d = $square_root;
        $n = $d + 1;
        $sum = 0;
        for ($i = 1; $i <= 1000; $i++) {
            /* // debug
            echo "#".$i.": ".bcdiv($n, $d, 20)."\n";
            echo $n."\n-------------------------------------------\n".$d."\n\n";
            */
            $n_new = bcadd($n, bcmul('2', $d));
            $d_new = bcadd($n, $d);
            $n = $n_new;
            $d = $d_new;
            $sum += strlen($n) > strlen($d) ? 1 : 0;
        }
        return $sum;
    }
}
