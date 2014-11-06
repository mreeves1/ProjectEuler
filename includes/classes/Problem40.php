<?php
/**
 * Project Euler - Problem 40
 *
 * Champernowne's constant
 *
 * An irrational decimal fraction is created by concatenating the positive integers:
 * 0.123456789101112131415161718192021...
 * It can be seen that the 12th digit of the fractional part is 1.
 * If dn represents the nth digit of the fractional part, find the value of the following expression.
 * d1 × d10 × d100 × d1000 × d10000 × d100000 × d1000000 
 *
 * @category ProjectEuler
 * @package Problem40
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=40
 *
 */
class Problem40 extends Problem_Abstract
{
    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

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
        return $this->findChampernownesConstantProduct();
    }

    /**
     * Find the product of the 1e0, 1e1, 1e2, 1e3, 1e4, 1e5, 1e6 digits of
     * Chamernowne's Constant
     *
     * @return int product of those 1e0th to 1e6th digits
     */
    private function findChampernownesConstantProduct(){
        $const = "0.";
        $i = 1;
        while (strlen($const) <= 1000002) {
            $const .= (string) $i;
            $i++;
        }
        $product = 1;
        $const_indices = array(1, 10, 100, 1000, 10000, 100000, 1000000);
        foreach ($const_indices as $index) {
            $d_n = (int) substr($const, $index + 1, 1);
            echo "d = ".$d_n."\n";
            $product *= $d_n;
        }

        return $product;
    }
}
