<?php
/**
 * Project Euler - Problem 43
 *
 * Sub-string divisibility
 *
 * The number, 1406357289, is a 0 to 9 pandigital number because it is made up of each of the digits 0 to 9 in some order, but it also has a rather interesting sub-string divisibility property.

 * Let d1 be the 1st digit, d2 be the 2nd digit, and so on. In this way, we note the following:

 * d<sub>2</sub>d<sub>3</sub>d<sub>4</sub> = 406 is divisible by 2

 * d<sub>3</sub>d<sub>4</sub>d<sub>5</sub> = 063 is divisible by 3

 * d<sub>4</sub>d<sub>5</sub>d<sub>6</sub> = 635 is divisible by 5

 * d<sub>5</sub>d<sub>6</sub>d<sub>7</sub> = 357 is divisible by 7

 * d<sub>6</sub>d<sub>7</sub>d<sub>8</sub> = 572 is divisible by 11

 * d<sub>7</sub>d<sub>8</sub>d<sub>9</sub> = 728 is divisible by 13

 * d<sub>8</sub>d<sub>9</sub>d<sub>10</sub> = 289 is divisible by 17

 * Find the sum of all 0 to 9 pandigital numbers with this property. 
 *
 * @category ProjectEuler
 * @package Problem43
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=43
 *
 */
class Problem43 extends Problem_Abstract
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
     * Description of input
     * @const string INPUT
     */
    // const UPPER_BOUND = 9876543210;
    const UPPER_BOUND = 1567894320;

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
        // return $this->isSubstringDivisible(1406357289);
        return $this->sumSubStringDivisiblePandigitalNumbers(self::UPPER_BOUND);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function sumSubStringDivisiblePandigitalNumbers($upper_bound){
        $pandigital_sum = 0;
        for ($i = 1234567890; $i <= $upper_bound; $i++) {
            if ($this->isSubstringDivisible($i)) {
                echo "Found substring divisible # $i\n"; // debug
                if ($this->isPandigital($i)) {
                    $pandigital_sum += $i;
                    echo "Added $n to sum.\n"; // debug
                }
            }
        }
        return $pandigital_sum;
    }

    /**
     * Test for pandigital-ness                            
     * e.g. when a numbers digits are ordered they go from 0 to n where n is the number of digits in the number
     *                                                     
     * @param string $n Number to check                    
     *                                                     
     * @return boolean Is number pandigital?               
     */                                                    
    private function isPandigital($n) 
    {                    
        $digits = str_split($n);                           
        rsort($digits);                                     
        $digits_str = implode("", $digits);                
        $test_full = "9876543210";                          
        $test_str = substr($test_full, 0, strlen($digits_str));
        return (strcmp($test_str, $digits_str) === 0);     
    }

    private function isSubstringDivisible($n) 
    {
        $divisors = array(2, 3, 5, 7, 11, 13, 17);
        for ($i = 1; $i <= 7; $i++) {
            $num = (int) substr($n, $i, 3);
            $div = $divisors[$i - 1];
            if ($n == 1406357289) {
                echo "$n , numerator: $num, divisor: $div \n";
            }
            if ($num % $div != 0) {
                return false;
            }
        }
        return true;
    }
}
