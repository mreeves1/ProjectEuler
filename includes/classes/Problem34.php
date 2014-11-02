<?php
/**
 * Project Euler - Problem 34
 *
 * Digit factorials
 *
 * 145 is a curious number, as 1! + 4! + 5! = 1 + 24 + 120 = 145.
 * Find the sum of all numbers which are equal to the sum of the factorial of their digits.
 * Note: as 1! = 1 and 2! = 2 are not sums they are not included. 
 *
 * @category ProjectEuler
 * @package Problem34
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=34
 *
 */
class Problem34 extends Problem_Abstract
{
    /**
     * Project Euler says each problem should take no more than 1 minute. 
     * If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method to control how long it 
     * takes for the script to timeout
     */
    const TIMEOUT_OVERRIDE = 60;

    /**
     * Project Euler is silent on space complexity. PHP uses a LOT of memory for arrays. 
     * Something like 20x what you would expect. 
     * @const int MEMORY_OVERRIDE Used with an override method to control how much memory
     * the script is allowed to consume.
     */
    const MEMORY_OVERRIDE = '64M';

    /**
     * Upper bound of numbers we check
     * I feel like this should be picked more intelligently
     * instead of an arbitrarily large number... 
     * @const int UPPER_BOUND
     */
    const UPPER_BOUND = 10000000;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

        // $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);

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
        $sumCurious = 0;
        for ($i = 3; $i < self::UPPER_BOUND; $i++) {
            if ($this->isCurious($i)) {
                $sumCurious += $i;
                echo $i." is curious!\n";
            } 
        }
        return $sumCurious;
    }

    /**
     * Check if a number = the factorial of each of its digits
     *
     * @param string $number The number we are testing
     *
     * @return boolean Is the number "Curious"?
     */
    private function isCurious($number)
    {
        $digits = str_split((string)$number);
        $sum_facts = 0;
        foreach ($digits as $digit) {
            $sum_facts += $this->fact($digit);
            if ($sum_facts > $number) {
                return false; // optimization?
            } 
        }
        return ($number === $sum_facts);
    }

    /**
     * Calculate the factorial of a number
     *
     */
    private function fact($x) {
        // cache previously calculated factorials (just caching at the top level would suffice)
        static $memento_array = array(); 
        $result = 1;
        $x_orig = $x;

        while ($x > 0) {
            if (isset($memento_array[$x])) {
                $x_fact = $memento_array[$x];
                $result *= $x_fact;
                break;
            } else {
                $result *= $x;
                $x--;
            }
        }
        if (!isset($memento_array[$x_orig])) {
            echo "Factorial cached for ".$x_orig."\n";;
            $memento_array[$x_orig] = $result; // only need to save when not set
        }
        return $result;
    }
}
