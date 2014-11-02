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
    Some references:
    http://en.wikipedia.org/wiki/Permutation#Systematic_generation_of_all_permutations
    http://pear.php.net/package/Math_Combinatorics
    http://cogo.wordpress.com/2008/01/08/string-permutation-in-php/
    http://stackoverflow.com/questions/5506888/permutations-all-possible-sets-of-numbers    
    */

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method
     */
    const TIMEOUT_OVERRIDE = 60;
    
    /**
     * Project Euler is silent on space complexity. PHP uses a LOT of memory for arrays. 
     * Something like 20x what you would expect. 
     * @const int MEMORY_OVERRIDE Used with an override method
     */
    const MEMORY_OVERRIDE = '1024M';

    /**                                                                            
      * The array of digits we wish to permute
      * @array $input_digits
      */
    private $input_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); // Problem Value
    // private $input_digits = array('0', '1', '2', '3'); // Test Value: should be n! combinations (aka 4! = 24)
    // private $input_digits = array('0', '1', '2'); // Test Value: should be n! combinations (aka 3! = 6)

    private $permutations = array();

    /**
     * The nth element of our Lexicographic permutations
     * @const string INPUT
     */
    const INPUT_PERMUTATION_INDEX = 1000000;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
        
        $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        $this->pc_permute($this->input_digits);
        $perm_count = count($this->permutations);
        if ($perm_count < 100) {
            echo var_export($this->permutations);
            return "Test Case Only";
        } else {
            sort($this->permutations);
            return $this->permutations[self::INPUT_PERMUTATION_INDEX - 1];
        }

    }

    /**
     * Find all permutations of a given set of values in an array
     * Save the results in an external array (probably should use an aggregator instead)
     *
     * Source of this algoritm: http://stackoverflow.com/a/5506933/699493
     * Original source: O'Reilly PHP Cookbook
     * @param string $number description
     *
     * @return int description
     */
    public function pc_permute($items, $perms = array()) {
        if (empty($items)) { 
            $this->permutations[] = implode('', $perms);
        } else {
            /* TODO: Come back and understand this algoritm better.
             * In the first run through it calls itself recursively on the variables
             * array(0,1,2), array(3) and then array(0,1,3), array(2), eg it is yanking a value out each time.
             * I think that is the key to the combinatorial expansion. 
             */
            for ($i = count($items) - 1; $i >= 0; --$i) {
                $newitems = $items;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                $this->pc_permute($newitems, $newperms);
            }
        }
    }
}
