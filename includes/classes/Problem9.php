<?php
/**
 * Project Euler - Problem 9
 *
 * Special Pythagorean triplet
 *
 * A Pythagorean triplet is a set of three natural numbers, a  b  c, for which,
 * a^2 + b^2 = c^2
 * For example, 3^2 + 4^2 = 9 + 16 = 25 = 5^2.
 *
 * There exists exactly one Pythagorean triplet for which a + b + c = 1000.
 * Find the product a*b*c.
 *
 * @category ProjectEuler
 * @package Problem9
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=9
 *
 */
class Problem9 extends Problem_Abstract
{
    /**
     * Description of input
     * @const int INPUT
     */
    const INPUT = 1000; // problem value
    // const INPUT = 12; // test value should give us a triplet of 3, 4, 5 and a product of 60

    /**
     * Wrapper method to output our answer with the appropriate input variables
     * @return int
     */
    public function execute()
    {
        return $this->findSpecialPythagoreanTripletProduct(self::INPUT);
    }

    /**
     * Find product of special pythagorean triplet
     * @param int $sum Summation of triplet
     * @return int Product of triplet, a * b * c where a < b < c, a^2 + b^2 = c^2
     */
    private function findSpecialPythagoreanTripletProduct($sum)
    {
        $aMax = $sum - 3;
        $triplets = array();
        for ($a = 1; $a <= $aMax ; $a++) {
            for ($b = 2; $b <= $aMax + 1; $b++) {
                if ($b <= $a) {
                    continue;
                }
                $c = sqrt($a*$a + $b*$b);
                // echo $a.', '.$b.', '.$c.'<br/>'; // debug
                if ($c != floor($c)) {
                    continue;
                }
                if ($a + $b + $c == $sum) { // sqrt returns a float or double
                    $triplets = array($a, $b, $c);
                    break 2;
                }
            }
        }
        return array_product($triplets);
    }
}
