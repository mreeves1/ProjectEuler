<?php
/**
 * Project Euler - Problem 23
 *
 * Non-abundant sums
 *
 * A perfect number is a number for which the sum of its proper divisors is exactly equal to the number. For example, the sum of the proper divisors of 28 would be 1 + 2 + 4 + 7 + 14 = 28, which means that 28 is a perfect number.
 * A number n is called deficient if the sum of its proper divisors is less than n and it is called abundant if this sum exceeds n.
 * 
 * As 12 is the smallest abundant number, 1 + 2 + 3 + 4 + 6 = 16, the smallest number that can be written as the sum of two abundant numbers is 24. By mathematical analysis, it can be shown that all integers greater than 28123 can be written as the sum of two abundant numbers. However, this upper limit cannot be reduced any further by analysis even though it is known that the greatest number that cannot be expressed as the sum of two abundant numbers is less than this limit.
 * Find the sum of all the positive integers which cannot be written as the sum of two abundant numbers. 
 *
 * @category ProjectEuler
 * @package Problem23
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=23
 *
 */
class Problem23 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 600;

    /**
     * Description of input
     * @const string INPUT
     */
    const INPUT = 28123; // Problem Value // 492 seconds - BADLY need to optimize this!
    // const INPUT = 15000; // Test Value // 110 seconds

    private $abundantNumbers = array();

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
        return $this->findSumOfIntegersNotSumOfTwoAbundantNumbers(self::INPUT);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findSumOfIntegersNotSumOfTwoAbundantNumbers($upperLimit)
    {
        $returnSum = 0;
        for ($i = 1; $i <= $upperLimit; $i++) {
            if ($this->isAbundant($i)) {
                $this->abundantNumbers[] = $i;
                echo ($i % 500 == 0) ? $this->abundantNumbers[count($this->abundantNumbers) - 1] . " is abundant\n" : '';
            }
            $returnSum += $this->testNotSumOfTwoAbundantNumbers($i) ? $i : 0;
        }
        echo "Abundant Numbers\n******************\n".var_export($this->abundantNumbers, true)."\n"; // debug
        return $returnSum;
    }


    private function testNotSumOfTwoAbundantNumbers($x)
    {
        $iMax = count($this->abundantNumbers) - 1;
        for ($i = 0; $i < $iMax; $i++) {
            $testNum = $x - $this->abundantNumbers[$i];
            if ($testNum < 0) {
                // echo "found 1 $x\n"; // debug
                return true;
            } elseif (in_array($testNum, $this->abundantNumbers)) {
                return false;
            }
        }
        echo "found 2 $x\n"; // debug
        return true;
    }

    /**                                                                                                                                   
     * Find the divisors of a $number and return their sum                                                                           
     */                                                                                                                              
    private function isAbundant($number) {                                                                                      
        $divisors = array();
        for ($i = 1; $i < ceil($number/2) + 1; $i++) {
            if ($number % $i == 0) {                                                                                                 
                $divisors[] = $i;                                                                                                    
            }
        }
        $sum = array_sum($divisors);
        return ($sum > $number);
     }
}
