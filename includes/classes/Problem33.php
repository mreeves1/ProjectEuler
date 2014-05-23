<?php
/**
 * Project Euler - Problem 33
 *
 * Digit canceling fractions
 *
 * The fraction 49/98 is a curious fraction, as an inexperienced mathematician in attempting to simplify it may incorrectly believe that 49/98 = 4/8, which is correct, is obtained by cancelling the 9s.
 * We shall consider fractions like, 30/50 = 3/5, to be trivial examples.
 * There are exactly four non-trivial examples of this type of fraction, less than one in value, and containing two digits in the numerator and denominator.
 * If the product of these four fractions is given in its lowest common terms, find the value of the denominator. 
 *
 * @category ProjectEuler
 * @package Problem33
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=33
 *
 */
class Problem33 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Description of input
     * @const string MAX_NUM_DEN
     */
    const MAX_NUM_DEN = 99;

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
        return $this->findCuriousFractionsProductDenominator(self::MAX_NUM_DEN);
    }

    /**
     * Find the curious fractions (numerator and demoninator) as described above
     *
     * @param int $upperLimit maximim numerator and denominator 
     *
     * @return array $answers each element is an array where element 0 is numerator and element 1 is denominator
     */
    private function findCuriousFractions($upperLimit){
        $answers = array();
        for ($num = 11; $num <= $upperLimit; $num++) {
            for ($den = 11; $den <= $upperLimit; $den++) {
                $result1 = $num/$den;

                $num_tmp = (string) $num;
                $num1 = (int) $num_tmp{0};
                $num2 = (int) $num_tmp{1};
                $den_tmp = (string) $den;
                $den1 = (int) $den_tmp{0};
                $den2 = (int) $den_tmp{1};
     
                // result <= 1, denominator and numerator cannot be 0, nor the same as that would be "trivial"
                if ($result1 <= 1 && $den2 != 0 & $num1 != 0 && $num2 == $den1 && $num1 != $num2) {
                    $result2 = $num1/$den2;
                    if (round($result2, 5) == round($result1,5)) {
                        $answers[] = array($num1, $den2);
                        echo $num."/".$den." and ".$num1."/".$den2."<br>\n"; // debug
                    }
                }
                
                // result <= 1, denominator and numerator cannot be 0, nor the same as that would be "trivial"
                if ($result1 <= 1 && $den1 != 0 & $num2 != 0 && $num1 == $den2 && $num1 != $num2) {
                    $result3 = $num2/$den1;
                    if (round($result3, 5) == round($result1,5)) {
                        $answers[] = array($num2, $den1);
                        echo $num."/".$den." and ".$num2."/".$den1."<br>\n"; // debug
                    }
                }
            } 
        }
        return $answers;
    }


    /**
     * Find the denominator of all the products of the curious fractions once the numerator has been reduced
     *
     * @param int $upperLimit maximim numerator and denominator 
     *
     * @return int denominator of the product of the curious fractions
     */
    private function findCuriousFractionsProductDenominator($upperLimit){
        $answers = $this->findCuriousFractions($upperLimit);
        $product = 1;
        foreach ($answers as $a) {
            $num = $a[0];
            $den = $a[1];
            $product *= $num;
            $product /= $den;
        }
        $result = 1/$product; // This would not work of course if the numerator did not reduce to 1. Little cheat shortcut! 
        return $result;
    }
}
