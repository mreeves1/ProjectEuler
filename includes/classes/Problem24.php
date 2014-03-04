<?php
/**
 * Project Euler - Problem 24
 *
 * Lexicographic permutations
 *
 * A permutation is an ordered arrangement of objects. For example, 3124 is one possible permutation of the digits 1, 2, 3 and 4. If all of the permutations are listed numerically or alphabetically, we call it lexicographic order. The lexicographic permutations of 0, 1 and 2 are:
 * 012 021 102 120 201 210
 * What is the millionth lexicographic permutation of the digits 0, 1, 2, 3, 4, 5, 6, 7, 8 and 9? 
 *
 * @category ProjectEuler
 * @package Problem24
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=24
 *
 */
class Problem24 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    const INPUT_DIGITS = '0123456789';

    /**
     * Description of input
     * @const string INPUT
     */
    const INPUT_PERMUTATION_INDEX = 1000000;


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
        return $this->findPermutationIndex(self::INPUT_DIGITS, self::INPUT_PERMUTATION_INDEX);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findPermutationIndex($digits, $index){
        $permutations = array(); 
        $refDigits = $digits;
        for ($i = 0; $i < str_len($digits); $i++) {

            // copy $digits to a new array as a source for the position. so look for 0, then 1, etc.
            // or use strpos, substr and substr_replace
            // reminder: $newstr = substr_replace($oldstr, $str_to_insert, $pos, 0);
            for ($j = 0; $j < str_len($digits); $j++) {
              
                // $n = $str_split($digits);
                // $a = array(0,1,2,3,4,5,6,7,8,9);
                // $b = array_slice($a, 0, 1);
                // $c = array_slice($a, 1, 1);
                // $d = array_slice($a, 2);
                echo var_export(array_merge($c,$b,$d), true);

            }  

        }  


        return;
    }
}
